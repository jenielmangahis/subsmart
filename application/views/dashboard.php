<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
</link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
<link rel="stylesheet" href="<?= base_url("assets/plugins/morris.js/morris.css") ?>">
<!-- page wrapper start -->

<style>
    h1, .breadcrumb-item, h5, .tbl-employee-name, p, .qUickStartde > span, .header-title, a, .modal-title{
        font-family: Sarabun, sans-serif !important;
    }

    .pointer{
        cursor: pointer;
    }

    .dynamic-widget .card{
        height: 400px !important
    }

    .card-header{
        border-bottom: 1px solid gray !important;
        font-family: Sarabun, sans-serif !important;
    }

    .card-body h6{
        font-size: 16px;
        font-family: Open sans, Lato, Arial, sans-serif;
        font-weight: 400;
        line-height: 1.5;
    }

    .card-body .job-status{
        width:100%;
        background:#a5d8ff;
        color: rgb(33, 150, 243);
        text-align: center;
        font-size: 12px;
        line-height: 1.5;
        margin-top:10px;
    }

    .card-body .job-caption{
        color: #616161;
        font-size: 10px;
        font-family: Roboto, Lato, Arial, sans-serif;
        font-weight: 800;
        line-height: 1.3;
        text-transform: uppercase;
    }
    .smart__grid{
        background: #fff;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
        height: 78vh;
        padding: 10px;
    }
    .smart__grid > div{
        background: #f2f2f2;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="wrapper" style="padding: 80px 14px;">
    <div class="bg-white" style=" border-radius: 30px 30px 0 0;margin-top: 15px;">
        <?php $this->load->view('includes/sidebars/dashboard/dashboard', $sidebar); ?>
        <div id="main" class="container-fluid">
            <div class="page-title-box">
                <div class="row col-12 align-items-center d-flex">
                    <div class="col-sm-2 col-lg-3">
                        <h1 class="page-title" style="font-weight: 600; font-size: 1.75rem;">Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome <?php echo getLoggedName(); ?>!</li>
                        </ol>
                    </div>
                    <div class="col-lg-6 justify-content-center d-none d-lg-block">
                        <div class="col-lg-12" style="background: #ffffff; height:50px; height:130px; margin:0 auto; top:-27px; border-radius: 0 0 60px 60px; padding-top:25px;">
                            <div onclick="document.location = '<?php echo base_url('/customer/add_lead') ?>'" class="float-left col-lg-2 no-padding text-center pointer">
                                <img class="col-lg-8" src="<?= assets_url('img/shortcuts/') . 'new_customer_qs.png' ?>" style="margin: 0 auto;" />
                                <p>Add Customer</p>
                            </div>
                            <div class="float-left col-lg-2 no-padding text-center pointer" onclick="$('#modal_customer').modal('show')">
                                <img class="col-lg-8" src="<?= assets_url('img/shortcuts/') . 'find_customer_qs.png' ?>" style="margin: 0 auto;"  />
                                <p>Find Customer</p>
                            </div>
                            <div class="float-left col-lg-2 no-padding text-center pointer" onclick="document.location = '<?php echo base_url('job/new_job1') ?>'">
                                <img class="col-lg-8" src="<?= assets_url('img/shortcuts/') . 'add_job_qs.png' ?>" style="margin: 0 auto;"  />
                                <p>Add Job</p>
                            </div>
                            <div class="float-left col-lg-2 no-padding text-center pointer" onclick="$('#NewEvent').modal('show')">
                                <img class="col-lg-8" src="<?= assets_url('img/shortcuts/') . 'quick_link_qs.png' ?>" style="margin: 0 auto;"  />
                                <p>Quick Links</p>
                            </div>
                            <div class="float-left col-lg-2 no-padding text-center pointer" onclick="$('#newFeed').modal('show')">
                                <img class="col-lg-8" src="<?= assets_url('img/shortcuts/') . 'new_feed_qs.png' ?>" style="margin: 0 auto;"  />
                                <p>New Feed</p>
                            </div>
                            <div class="float-left col-lg-2 no-padding text-center pointer" onclick="$('#addNewsLetter').modal('show')">
                                <img class="col-lg-8" src="<?= assets_url('img/shortcuts/') . 'news_letter_qs.png' ?>" style="margin: 0 auto;"  />
                                <p>Add Newsletter</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="companyChecklist" tabindex="-1" role="dialog" aria-labelledby="companyChecklist" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-square"></i> Checklist</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="newFeed" tabindex="-1" role="dialog" aria-labelledby="addWidgets" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document" style="max-width: 592px; margin-top:230px;">
                            <div class="modal-content" style="border-radius: 30px;">
                                <div class="modal-header">
                                    <input type="text" placeholder="Subject Line" class="form-control" />
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <textarea style="height:130px;" class="form-control" placeholder="Feed Message" ></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="float-right btn btn-success btn-small">Send Feed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addNewsLetter" tabindex="-1" role="dialog" aria-labelledby="addWidgets" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document" style="max-width: 592px; margin-top:230px;">
                            <div class="modal-content" style="border-radius: 30px;">
                                <div class="modal-header">
                                    Company's News Letter
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <div class="modal-body text-center">
                                    <textarea style="height:130px;" class="form-control" placeholder="News Bulletin" ></textarea>
                                    <br />
                                    <input class="float-left" type="file" value="Upload File" />
                                </div>
                                <div class="modal-footer">
                                    <button class="float-right btn btn-success btn-small">Send Newsletter</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include viewPath('flash'); ?>
                    <div class="col-12 d-md-none d-block p-0">
                        <div class="smart__grid" id="1">
                            <div><a href="<?= base_url() ?>inquiries">Leads</a></div>
                            <div><a href="<?= base_url() ?>customer">Customers</a></div>
                            <div><a href="<?= base_url() ?>estimate">Estimates</a></div>
                            <div><a href="<?= base_url() ?>invoice">Invoices</a></div>
                            <div><a href="<?= base_url() ?>workcalender">Calendar</a></div>
                            <div><a href="<?= base_url() ?>workorder">Work Order</a></div>
                            <div><a href="<?= base_url() ?>users">Employees</a></div>
                            <div><a href="#">Route Planner</a></div>
                            <div><a href="<?= base_url() ?>accounting/reports">Reports</a></div>
                            <div><a href="<?= base_url() ?>inventory">Inventory</a></div>
                            <div><a href="<?= base_url() ?>survey">Quick Links</a></div>
                            <div><a href="<?= base_url() ?>users/businessview">Business</a></div>
                            <div><a href="<?= base_url() ?>accounting/banking">Accounting</a></div>
                            <div><a href="<?= base_url() ?>vault">Files Vault</a></div>
                            <div><a href="<?= base_url() ?>esignmain">eSign</a></div>
                            <div><a href="<?= base_url() ?>taskhub">Tasks</a></div>
                            <div><a href="#">Bulletin</a></div>
                            <div><a href="<?= base_url() ?>vault/beforeafter">Collage Maker</a></div>
                            <div><a href="<?= base_url() ?>estimate">Cost Estimator</a></div>
                            <div><a href="<?= base_url() ?>inventory">Virtual Estimator</a></div>
                            <div><a href="<?= base_url() ?>users/timelog">Time Clock</a></div>
                            <div><a href="<?= base_url() ?>customer">Marketing</a></div>
                            <div><a href="#">Trac 360</a></div>
                            <div><a href="<?= base_url() ?>job">Job</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="col-sm-12">
                <div class="col-sm-12 text-right-sm" style="align:right;">
                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                        <label class="onoffswitch-label" for="onoff-customize">
                            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row-tablet-mobile mb-fix">
                <div class="row d-none d-lg-flex" style="width:99%">
                    <?php //$this->load->view('widgets/quick_start', $quick_start_data); ?>
                    <div class="col-md-12">
                        <div class="row cus-dashboard-div sortable2 isMain">
                            <?php
                            foreach ($widgets as $wids):
                                if ($wids->wu_is_main):
                                    $data['class'] = 'col-lg-4 col-md-4 col-sm-12';
                                    $data['rawHeight'] = '420';
                                    $data['height'] = 'height: 420px;';
                                    $data['isMain'] = True;
                                    $data['id'] = $wids->w_id;
                                    $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);
                                    $this->load->view($wids->w_view_link, $data);
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row d-none d-lg-flex cus-dashboard-div dynamic-widget sortableWidget" id="widgetWrapper">
                    <?php
                    foreach ($widgets as $wids):
                        if (!$wids->wu_is_main):
                            $data['class'] = 'col-lg-3 col-md-6 col-sm-12';
                            $data['rawHeight'] = '360';
                            $data['height'] = 'height: 360px;';
                            $data['isMain'] = False;
                            $data['id'] = $wids->w_id;
                            $data['isGlobal'] = ($wids->wu_company_id == '0' ? false : true);
                            $this->load->view($wids->w_view_link, $data);
                        endif;
                    endforeach;
                    $this->load->view('widgets/add_widgets');
                    ?>
                </div>

                <!-- end row -->
                <br>
                <div class="row d-none d-lg-flex">
                    <div class="col-xl-12">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright" style="z-index:1;font-size: 12px !important;line-height: 32px !important;text-align: center !important;vertical-align: middle !important;font-family: 'Trebuchet MS', Arial, sans-serif !important;color: #45a2f3 !important;position: relative;bottom: 4px;"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                                {
                                "symbols": [
                                {
                                "proName": "FOREXCOM:SPXUSD",
                                        "title": "S&P 500"
                                },
                                {
                                "proName": "FOREXCOM:NSXUSD",
                                        "title": "Nasdaq 100"
                                },
                                {
                                "proName": "FX_IDC:EURUSD",
                                        "title": "EUR/USD"
                                },
                                {
                                "proName": "BITSTAMP:BTCUSD",
                                        "title": "BTC/USD"
                                },
                                {
                                "proName": "BITSTAMP:ETHUSD",
                                        "title": "ETH/USD"
                                },
                                {
                                "proName": "RF"
                                },
                                {
                                "proName": "LOW"
                                },
                                {
                                "proName": "HD"
                                },
                                {
                                "proName": "AMZN"
                                },
                                {
                                "proName": "HON"
                                },
                                {
                                "proName": "GE"
                                },
                                {
                                "proName": "AAPL"
                                },
                                {
                                "proName": "WMT"
                                },
                                {
                                "proName": "DIS"
                                },
                                {
                                "proName": "FB"
                                },
                                {
                                "proName": "CIT"
                                },
                                {
                                "proName": "UA"
                                },
                                {
                                "proName": "BAC"
                                },
                                {
                                "proName": "SSL"
                                },
                                {
                                "proName": "CNTY"
                                },
                                {
                                "proName": "MCD"
                                },
                                {
                                "proName": "CCL"
                                },
                                {
                                "proName": "KO"
                                },
                                {
                                "proName": "JBLU"
                                },
                                {
                                "proName": "AAL"
                                },
                                {
                                "proName": "NYMT"
                                },
                                {
                                "proName": "NFLX"
                                },
                                {
                                "proName": "BP"
                                },
                                {
                                "proName": "TGT"
                                },
                                {
                                "proName": "DAL"
                                },
                                {
                                "proName": "ZAGG"
                                },
                                {
                                "proName": "BUD"
                                },
                                {
                                "proName": "UPS"
                                },
                                {
                                "proName": "KIRK"
                                },
                                {
                                "proName": "BGG"
                                }
                                ],
                                        "colorTheme": "light",
                                        "isTransparent": false,
                                        "displayMode": "adaptive",
                                        "locale": "en"
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings Display -->
            <!-- end row -->
            <!-- end container-fluid -->
        </div>
    </div>

    <!-- page wrapper end -->
</div>

<!-- floating action button -->

<div class="col-12 d-md-none d-block p-0">
    <?php $this->load->view('dashboard/ringCentralActionButton'); ?>
</div>

<div style="display: none;" class="floating-btn-div div9">
    <label class="label"><a href="#">Schedule</a></label>
    <a href="#" class="float9">
        <i class="fa fa-stop-circle my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div1">
    <label class="label"><a href="#">Reschedule</a></label>
    <a href="#" class="float1">
        <i class="fa fa-calendar my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div2">
    <label class="label"><a href="#">Request Signature</a></label>
    <a href="#" class="float2">
        <i class="fa fa-external-link my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div3">
    <label class="label"><a href="#">Notes</a></label>
    <a href="#" class="float3">
        <i class="fa fa-file my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div4">
    <label class="label"><a href="#">Log Time</a></label>
    <a href="#" class="float4">
        <i class="fa fa-clock-o my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div5">
    <label class="label"><a href="#">Convert To Estimate</a></label>
    <a href="#" class="float5">
        <i class="fa fa-calculator my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div6">
    <label class="label"><a href="#">Convert To Invoice</a></label>
    <a href="#" class="float6">
        <i class="fa fa-money my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div7">
    <label class="label"><a href="#">Change Order</a></label>
    <a href="#" class="float7">
        <i class="fa fa-edit my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div8">
    <label class="label"><a href="#">Change Status</a></label>
    <a href="#" class="float8">
        <i class="fa fa-flag my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div10">
    <label class="label"><a href="#">Attach Photo</a></label>
    <a href="#" class="float10">
        <i class="fa fa-picture-o my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div11">
    <label class="label"><a href="#">Service Ticket</a></label>
    <a href="#" class="float11">
        <i class="fa fa-picture-o my-float"></i>
    </a>
</div>
<div style="display: none;" class="floating-btn-div div12">
    <label class="label"><a href="<?= base_url('customer/') ?>">Customers</a></label>
    <a href="<?= base_url('customer/') ?>" class="float12">
        <i class="fa fa-list my-float"></i>
    </a>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php echo form_open('dashboard/saveTags', ['class' => 'form-validate require-validation', 'id' => 'feed_form', 'autocomplete' => 'off']); ?>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="job_name">New Tag</label>
                        <input type="text" class="form-control" name="feed_subject" id="feed_subject" required/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- Customers List Modal -->
<?php include viewPath('customer/adv_modals/modal_customers_list'); ?>
<!-- CSS for dashboard cards -->
<style>
    .db-card{
        height : auto;
        margin: 0 auto !important;
        width: 100% !important;
        display: grid;
        grid-auto-flow: column;
    }
</style>
<style type="text/css">
    .ui-state-default{
        border: 0 !important;
        background: #dddddd !important;
    }
    .float1, .float2, .float3, .float4, .float5, .float6, .float7, .float8, .float9, .float10, .float11, .float12 {
        color: #2d1a3e;
        background-color: #fff;
        border-radius: 25px;
        margin-bottom: 5px;
    }
    .float1, .float12{
        position:fixed;
        width:40px;
        height:40px;
        bottom:40px;
        right:20px;
        /*background-color:#0C9;*/
        /*color:#FFF;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div1 , .div12{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 40px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float2{
        position:fixed;
        width:40px;
        height:40px;
        bottom:110px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div2 {
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 110px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float3{
        position:fixed;
        width:40px;
        height:40px;
        bottom:180px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div3 {
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 180px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float4{
        position:fixed;
        width:40px;
        height:40px;
        bottom:250px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div4{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 250px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float5{
        position:fixed;
        width:40px;
        height:40px;
        bottom:320px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div5{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 320px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float6{
        position:fixed;
        width:40px;
        height:40px;
        bottom:390px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div6{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 390px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float7{
        position:fixed;
        width:40px;
        height:40px;
        bottom:460px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div7{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 460px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float8{
        position:fixed;
        width:40px;
        height:40px;
        bottom:530px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div8{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 530px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float9{
        position:fixed;
        width:40px;
        height:40px;
        bottom:600px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div9{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 600px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float10{
        position:fixed;
        width:40px;
        height:40px;
        bottom:670px;
        right:20px;
        /*background-color:transparent;*/
        /*color:#2d1a3e;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div10{
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 670px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .float11{
        position:fixed;
        width:40px;
        height:40px;
        bottom:740px;
        right:20px;
        /*background-color:#0C9;*/
        /*color:#FFF;*/
        /*border-radius:50px;*/
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    .div11 {
        width: 250px;
        /*border: 1px solid #000;*/
        position: fixed;
        height: 50px;
        bottom: 740px;
        right: 20px;
        text-align: center;
        color: #fff;
        background-color: #ccc;
    }
    .label{
        margin-top: 15px;
    }
    .my-float{
        /*margin-top:22px;*/
        /*margin-top:20px;*/
        margin-top: 15px;
    }
    /* Important stuff */
    .mdc-bottom-navigation {
        height: 56px;

        width: 100%;
        box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        z-index: 8;
    }
    .hid-desk{
        display: none;
    }
    @media only screen and (max-width: 600px) {
        .mb-fix {
            margin-top: 26px;
        }
        .hid-desk{
            display: block !important;
        }
    }
</style>
<?php include viewPath('includes/footer'); ?>


<script type="text/javascript">

    function load_checklist(){
    var url = base_url + 'users/_load_checklist';
    $("#companyChecklist").modal('show');
    setTimeout(function () {
    $.ajax({
    type: "POST",
            url: url,
            dataType: "json",
            success: function(o)
            {
            $("#companyChecklist").modal('show');
            }
    });
    }, 1000);
    }

    function waitForClockInOut() {
    $.ajax({
        type: "GET",
                url: "<?= base_url() ?>/Timesheet/getClockInOutNotification",
                async: true,
                cache: false,
                timeout: 10000,
                success: function (data) {

                var obj = JSON.parse(data);
                console.log(obj);
                $.each(obj, function (currentIndex, currentElem) {
                $('#in_now').html(currentElem.ClockIn);
                $('#out_now').html(currentElem.ClockOut);
                });
                setTimeout(waitForClockInOut, 2000);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(waitForClockInOut, 15000);
                }
        });
    };
    $(document).ready(function () {
        var TimeStamp = null;
        waitForClockInOut();
        
       // alert("Your screen resolution is: " + screen.width + "x" + screen.height);
        
        $('#onoff-customize').change(function () {
            if (this.checked) {
                $('.widget').mouseover(function(){
                    if($(this).attr('id')=='addWidget'){
                        $(".sortable2").sortable("disable");
                        $(".sortableWidget").sortable("disable");
                    }else{
                        $(".sortable2").sortable("enable");
                        $(".sortableWidget").sortable("enable");
                    }
                });
            } else {
                $(".sortable2").sortable("disable");
                $(".sortableWidget").sortable("disable");
            }

        });



        $(".sortable2").sortable({
            start: function (e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
                $(this).attr('style', 'top:0;cursor: grabbing', 'z-index:10000');

            },
            change(event, ui)
            {
                $(this).attr('style', 'top:0;cursor: grabbing ', 'z-index:10000');
            },
            update: function (e, ui)
            {
                var isMain = ($(this).hasClass('isMain')?'1':'0');
                $(this).attr('style', 'top:0;cursor: pointer');
                var oldOrder = $(this).attr('data-previndex');
                var idsInOrder = $(".sortable2").sortable("toArray",{ attribute: 'data-id' });
                var filteredArray = idsInOrder.filter(function(e){return e});

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/widgets/changeOrder",
                    data: {ids: filteredArray.toString(), isMain: isMain}, // serializes the form's elements.
                    success: function (data)
                    {
                        console.log(data);
                    }
                });

                console.log(filteredArray.toString());
            }
        });

        //$(".sortable2").sortable("disable");


        $(".sortableWidget").sortable({
            start: function (e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
                $(this).attr('style', 'top:0;cursor: grabbing', 'z-index:10000');

            },
            change(event, ui)
            {
                $(this).attr('style', 'top:0;cursor: grabbing ', 'z-index:10000');
            },
            update: function (e, ui)
            {
                var isMain = ($(this).hasClass('isMain')?'1':'0');
                $(this).attr('style', 'top:0;cursor: pointer');
                var oldOrder = $(this).attr('data-previndex');
                var idsInOrder = $(".sortableWidget").sortable("toArray",{ attribute: 'data-id' });
                var filteredArray = idsInOrder.filter(function(e){return e});

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/widgets/changeOrder",
                    data: {ids: filteredArray.toString(), isMain: isMain}, // serializes the form's elements.
                    success: function (data)
                    {
                        console.log(data);
                    }
                });

                console.log(filteredArray.toString());
            }
        });

        //$(".sortableWidget").sortable("disable");
    });

</script>