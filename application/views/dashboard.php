<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
</link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
<link rel="stylesheet" href="<?=base_url("assets/plugins/morris.js/morris.css")?>">
<!-- page wrapper start -->
<div class="wrapper">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-2">
                    <h1 class="page-title">Dashboard</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Welcome to  Dashboard</li>
                    </ol>
                </div>
                <?php include viewPath('flash'); ?>
                <style>
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
                <div class="col-12 d-md-none d-block p-0">
                    <div class="smart__grid" id="1">
                        <div><a href="<?= base_url()?>inquiries">Leads</a></div>
                        <div><a href="<?= base_url()?>customer">Customers</a></div>
                        <div><a href="<?= base_url()?>estimate">Estimates</a></div>
                        <div><a href="<?= base_url()?>invoice">Invoices</a></div>
                        <div><a href="<?= base_url()?>workcalender">Calendar</a></div>
                        <div><a href="<?= base_url()?>workorder">Work Order</a></div>
                        <div><a href="<?= base_url()?>users">Employees</a></div>
                        <div><a href="#">Route Planner</a></div>
                        <div><a href="<?= base_url()?>accounting/reports">Reports</a></div>
                        <div><a href="<?= base_url()?>inventory">Inventory</a></div>
                        <div><a href="<?= base_url()?>survey">Quick Links</a></div>
                        <div><a href="<?= base_url()?>users/businessview">Business</a></div>
                        <div><a href="<?= base_url()?>accounting/banking">Accounting</a></div>
                        <div><a href="<?= base_url()?>vault">Files Vault</a></div>
                        <div><a href="<?= base_url()?>esignmain">eSign</a></div>
                        <div><a href="<?= base_url()?>taskhub">Tasks</a></div>
                        <div><a href="#">Bulletin</a></div>
                        <div><a href="<?= base_url()?>vault/beforeafter">Collage Maker</a></div>
                        <div><a href="<?= base_url()?>estimate">Cost Estimator</a></div>
                        <div><a href="<?= base_url()?>inventory">Virtual Estimator</a></div>
                        <div><a href="<?= base_url()?>users/timelog">Time Clock</a></div>
                        <div><a href="<?= base_url()?>customer">Marketing</a></div>
                        <div><a href="#">Trac 360</a></div>
                    </div>
                </div>
                <div class="col-sm-6 d-none d-lg-flex">
                </div>
                <div class="col-sm-4">
                    <div class="float-right d-none d-md-block">
                        <ol class="breadcrumb">
                            <?php $image = base_url('uploads/users/default.png'); ?>
                            <!-- <img src="<?php echo $image; ?>" alt="user" class="rounded-circle" style="height: 50px;"> -->
                            <img src="<?php echo userProfileImage(logged('id')) ?>" alt="user" class="rounded-circle" style="height: 50px;">
                            <?php
                                /*$id = logged('id');
                                $query = $this->db->query("Select name from users where id = $id");
                                $query11 = $query->row();  */
                                ?>
                            <h5 style="margin: 13px 0 0px 10px;"><?php echo getLoggedName();?></h5>
                        </ol>
                        <!--
                            <div class="dropdown"><button
                                    class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="mdi mdi-settings mr-2"></i> Settings</button>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                        href="index.html#">Action</a> <a class="dropdown-item"
                                        href="index.html#">Another action</a> <a class="dropdown-item"
                                        href="index.html#">Something else here</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item"
                                        href="index.html#">Separated link</a>
                                </div>
                            </div>
                            -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <style>
            .qUickStart{
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#fcfcfc+0,eaeaea+100 */
            background: #fcfcfc; /* Old browsers */
            background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
            display: flex;
            align-items: center;
            padding: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-bottom:15px;
            }
            .qUickStart:last-child{
            margin-bottom:0px;
            }
            .qUickStart .icon{
            background:#2d1a3e !important;
            flex: 0 0 70px;
            height: 70px;
            border-radius: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            color:#fff;
            margin-right: 10px;
            }
            .qUickStart .qUickStartde h4{
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0;
            margin-bottom: 0px;
            margin-bottom: 6px;
            }
            .qUickStart .qUickStartde span{
            opacity: 0.6;
            }
        </style>
        <div class="row-tablet-mobile">
        <div class="row d-none d-lg-flex">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Quick Start</h4>
                        <a href="<?php echo url('/customer/add_lead') ?>">
                            <div class="qUickStart">
                                <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">A</span>
                                <div class="qUickStartde">
                                    <h4>Add a New Client</h4>
                                    <span>Sign up a new client and add to database</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a href="javascript:void(0);" id="btn_select_existing_client">
                            <div class="qUickStart">
                                <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">B</span>
                                <div class="qUickStartde">
                                    <h4>Select an Existing Client</h4>
                                    <span>Work with an existing client</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a id="shortcut_link" href="#<?php //echo url('/workorder/add') ?>">
                            <div class="qUickStart">
                                <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">C</span>
                                <div class="qUickStartde">
                                    <h4>Add a New Event</h4>
                                    <span>Choose from a various quick shortcuts</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal">
                            <div class="qUickStart">
                                <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">D</span>
                                <div class="qUickStartde">
                                    <h4>Add a New Feed</h4>
                                    <span>Send a Private Message to Particular User</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal2">
                            <div class="qUickStart">
                                <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">E</span>
                                <div class="qUickStartde">
                                    <h4>Add a News Letter</h4>
                                    <span>Send a Company Newslatter to All User</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row cus-dashboard-div">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-purple card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">monetization_on</i>
                          </div>
                          <p class="card-category">EARNED TODAY</p>
                          <h3 class="card-title">$0.00</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">date_range</i> Since last month
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-purple card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">receipt_long</i>
                          </div>
                          <p class="card-category">TOTAL JOBS MONTH TO DATE</p>
                          <h3 class="card-title">0 (Avg: $0.00)</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">date_range</i> Since last month
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-purple card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">assignment_turned_in</i>
                          </div>
                          <p class="card-category">TOTAL INVOICE DUE</p>
                          <h3 class="card-title">$0.00 (0)</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">date_range</i> Since last month
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-purple card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">account_circle</i>
                          </div>
                          <p class="card-category">TOTAL ESTIMATE PENDING</p>
                          <h3 class="card-title">0.00</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">date_range</i> Since last month
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="progress-fill-card">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">In now</h5>
                            <h5 class="font-16 mt-0">0</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">Out now</h5>
                            <h5 class="font-16 mt-0">11</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 91%" aria-valuenow="91%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">
                
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">No logged-in Today</h5>
                            <h5 class="font-16 mt-0">11</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 91.67%" aria-valuenow="91.67" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">
                
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">Employees</h5>
                            <h5 class="font-16 mt-0">12</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 91.67%" aria-valuenow="91.67" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">
                
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">On Approved Leave</h5>
                            <h5 class="font-16 mt-0">12</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">
                
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">On Unapproved Leave</h5>
                            <h5 class="font-16 mt-0">12</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">

                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">On Leave</h5>
                            <h5 class="font-16 mt-0">0</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="progress-fill-card">
                
                <div class="card">
                    <div class="card-body p-0">
                        <div class="d-flex top-block">
                            <h5 class="font-16 mt-0">On Business Travel</h5>
                            <h5 class="font-16 mt-0">0</h5>
                        </div>
                        <div class="mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
                </div>
            </div>
        </div>

        <!-- <div class="row progress-fill-card">
            
        </div> -->
            <!-- Earnings Display -->
            <div class="row d-none d-lg-flex mb-1">
                <div class="col-sm-6">
                    <div class="dropdown dropdown-inline filter-date">
                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <span class="fa fa-calendar margin-right-sec"></span><span data-filter-date="selected-item-name">This Year</span> <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu btn-block" role="menu">
                            <li data-filter-date="item" data-date-start="2020-01-01" data-date-end="2020-12-31" data-name="This Year" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year</a></li>
                            <li data-filter-date="item" data-date-start="2020-07-01" data-date-end="2020-09-30" data-name="This Year - Q3" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year - Q3</a></li>
                            <li data-filter-date="item" data-date-start="2020-04-01" data-date-end="2020-06-30" data-name="This Year - Q2" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year - Q2</a></li>
                            <li data-filter-date="item" data-date-start="2020-01-01" data-date-end="2020-03-31" data-name="This Year - Q1" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year - Q1</a></li>
                            <li data-filter-date="item" data-date-start="2020-08-01" data-date-end="2020-08-31" data-name="This Month" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Month</a></li>
                            <li data-filter-date="item" data-date-start="2020-08-03" data-date-end="2020-08-09" data-name="This Week" role="presentation"><a role="menuitem" tabindex="-1" href="#">This Week</a></li>
                            <li data-filter-date="item" data-date-start="2019-01-01" data-date-end="2019-12-31" data-name="Previous Year" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year</a></li>
                            <li data-filter-date="item" data-date-start="2019-10-01" data-date-end="2019-12-31" data-name="Previous Year - Q4" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q4</a></li>
                            <li data-filter-date="item" data-date-start="2019-07-01" data-date-end="2019-09-30" data-name="Previous Year - Q3" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q3</a></li>
                            <li data-filter-date="item" data-date-start="2019-04-01" data-date-end="2019-06-30" data-name="Previous Year - Q2" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q2</a></li>
                            <li data-filter-date="item" data-date-start="2019-01-01" data-date-end="2019-03-31" data-name="Previous Year - Q1" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Year - Q1</a></li>
                            <li data-filter-date="item" data-date-start="2020-07-01" data-date-end="2020-07-31" data-name="Previous Month" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Month</a></li>
                            <li data-filter-date="item" data-date-start="2020-07-27" data-date-end="2020-08-02" data-name="Previous Week" role="presentation"><a role="menuitem" tabindex="-1" href="#">Previous Week</a></li>
                            <li data-filter-date="item" data-date-start="2018-01-01" data-date-end="2018-12-31" data-name="FY 2018" role="presentation"><a role="menuitem" tabindex="-1" href="#">FY 2018</a></li>
                            <li data-filter-date="item" data-date-start="2017-01-01" data-date-end="2017-12-31" data-name="FY 2017" role="presentation"><a role="menuitem" tabindex="-1" href="#">FY 2017</a></li>
                            <li data-filter-date="item" data-date-start="2016-01-01" data-date-end="2016-12-31" data-name="FY 2016" role="presentation"><a role="menuitem" tabindex="-1" href="#">FY 2016</a></li>
                        </ul>
                    </div>
                    <span class="margin-left">For <span data-date-filter="date-interval">01-Jan-2020 to 31-Dec-2020</span></span>
                </div>
                <div class="col-sm-6 text-right-sm">
                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">customize</span>
                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize"> <label class="onoffswitch-label" for="onoff-customize"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                    </div>
                </div>
            </div>
            <!-- Earnings Display -->


            <div class="row d-none d-lg-flex sortable2 MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2" id="sortable">
            <?php
            $modules = explode(",", $dashboard_sort->ds_values);
            for($x=0;$x<count($modules);$x++){
                if(!empty($modules[$x])){
                  include viewPath('dashboard/'.$modules[$x]);
                }
            }
            ?>

            <!-- <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3 short_id" id="item_3">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-6 15h-2v-2h2v2zm0-4h-2V8h2v6zm-1-9c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss63">Open invoices</span>
                                    </h6>
                                </span>
                            </div>
                            <div class="MuiCardHeader-action"></div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div style="height: 100%;">
                                <h3 class="MuiTypography-root MuiTypography-h3 MuiTypography-alignRight">$<?php echo get_invoice_amount('year') ?></h3>
                                <div class="MuiTypography-root MuiTypography-caption MuiTypography-alignRight">Open invoices</div>
                                <div class="recharts-responsive-container" style="width: 100%; height: 200px; position: relative;">
                                    <div class="recharts-wrapper" style="position: relative; cursor: default; width: 422px; height: 200px;">
                                        <svg class="recharts-surface" width="422" height="200" viewBox="0 0 422 200" version="1.1">
                                            <g class="recharts-layer recharts-bar-graphical">
                                                <g class="recharts-layer recharts-bar">
                                                    <g class="recharts-layer recharts-bar-rectangles">
                                                        <g class="recharts-layer recharts-bar-rectangle">
                                                            <path width="60" height="0" color="#d81b60" x="43" y="16.74191230769233" cursor="pointer" fill="#d81b60" class="recharts-rectangle" d="M 43,16.74191230769233 h 60 v 0 h -60 Z"></path>
                                                        </g>
                                                        <g class="recharts-layer recharts-bar-rectangle">
                                                            <path width="60" height="0" color="#ffb300" x="180.33333333333334" y="195" cursor="pointer" fill="#ffb300" class="recharts-rectangle" d="M 180.33333333333334,195 h 60 v 0 h -60 Z"></path>
                                                        </g>
                                                        <g class="recharts-layer recharts-bar-rectangle">
                                                            <path width="60" height="0" color="#2196f3" x="317.6666666666667" y="172.08804615384616" cursor="pointer" fill="#2196f3" class="recharts-rectangle" d="M 317.6666666666667,172.08804615384616 h 60 v 0 h -60 Z"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                        <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; left: 0px; top: 0px; width: 415px; height: 193px;">
                                            </div>
                                        </div>
                                        <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; left: 0px; top: 0px; width: 200%; height: 200%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiGrid-root MuiGrid-container">
                                    <div class="MuiGrid-root jss65 jss70 MuiGrid-item MuiGrid-grid-xs-true">
                                        <p class="MuiTypography-root MuiTypography-body1 MuiTypography-alignCenter">$<?php echo get_invoice_amount('year') ?></p>
                                        <div class="MuiTypography-root MuiTypography-caption MuiTypography-alignCenter">Past due</div>
                                    </div>
                                    <div class="MuiGrid-root jss66 jss70 MuiGrid-item MuiGrid-grid-xs-true">
                                        <p class="MuiTypography-root MuiTypography-body1 MuiTypography-alignCenter">$<?php echo get_invoice_amount('due') ?></p>
                                        <div class="MuiTypography-root MuiTypography-caption MuiTypography-alignCenter">Due</div>
                                    </div>
                                    <div class="MuiGrid-root jss67 jss70 MuiGrid-item MuiGrid-grid-xs-true">
                                        <p class="MuiTypography-root MuiTypography-body1 MuiTypography-alignCenter">$<?php echo get_invoice_amount('pending') ?></p>
                                        <div class="MuiTypography-root MuiTypography-caption MuiTypography-alignCenter">Unsent</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
        <br>
        <!-- end row -->
        <div class="row d-none d-lg-flex sortable2">
            <?php
            /*$modules = explode(",", $dashboard_sort);
            for($x=0;$x<count($modules) -1;$x++){
            include viewPath('dashboard/'.$modules[$x]);
            }*/
            //  include viewPath('dashboard/report2');
            ?>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_14">
                <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                    <div class="jss53">
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column MuiGrid-align-items-xs-center MuiGrid-justify-xs-center">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column MuiGrid-align-items-xs-center MuiGrid-justify-xs-center">
                                <div class="MuiGrid-root MuiGrid-item">
                                    <p class="MuiTypography-root MuiTypography-body1 MuiTypography-alignCenter">Track stats important to your business</p>
                                </div>
                                <div class="MuiGrid-root MuiGrid-item">
                                    <button class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" type="button">
                                    <span class="MuiButton-label">Upgrade to Plan</span>
                                    <span class="MuiTouchRipple-root"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                        <div class="MuiCardHeader-avatar">
                            <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                <path d="M10 20h4V4h-4v16zm-6 0h4v-8H4v8zM16 9v11h4V9h-4z"></path>
                            </svg>
                        </div>
                        <div class="MuiCardHeader-content">
                            <span class="">
                                <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                    <span class="jss55 jss100">Add more report</span>
                                </h6>
                            </span>
                        </div>
                    </div>
                    <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                    <div class="MuiCardContent-root jss60" style="height: 309px;"></div>
                </div>
            </div>    
        </div>
        <!-- end row -->

        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2" id="sortable">

                <!-- <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-3 MuiGrid-grid-xl-2 short_id" id="item_8">
                    <div class="c65 c61">
                        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                                <div class="MuiCardHeader-avatar">
                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
                                    </svg>
                                </div>
                                <div class="MuiCardHeader-content">
                                    <span class="">
                                        <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                            <span class="jss55 jss93">Jobs by tags</span>
                                        </h6>
                                    </span>
                                </div>
                                <div class="MuiCardHeader-action" style="margin-top:5px;">
                                    <span title="Create Tags" class="jss55 jss93"><a href="javascript:void(0)" class="card-link text-success" data-toggle="modal" data-target="#exampleModal3">Create Tags</a></span>
                                </div>
                            </div>
                            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                            <div class="MuiCardContent-root jss60" style="height: 309px;">
                                <div class="recharts-responsive-container" style="width: 100%; height: 256px; position: relative;">
                                    <div class="recharts-wrapper" style="cursor: default; position: relative; width: 265px; height: 256px;">
                                        <svg class="recharts-surface" width="265" height="256" viewBox="0 0 265 256" version="1.1">
                                            <g class="recharts-layer recharts-area">
                                                <g class="recharts-layer recharts-radial-bar-background">
                                                    <path fill="#eee" class="recharts-sector recharts-radial-bar-background-sector" d="M 11.785714285714292,191.99999999999997A 120.71428571428571,120.71428571428571,0,0,1,253.21428571428572,192L 243.21428571428572,192A 110.71428571428571,110.71428571428571,0,0,0,21.785714285714292,192 Z"></path>
                                                    <path fill="#eee" class="recharts-sector recharts-radial-bar-background-sector" d="M 28.92857142857143,192A 103.57142857142857,103.57142857142857,0,0,1,236.07142857142856,192L 226.07142857142856,192A 93.57142857142857,93.57142857142857,0,0,0,38.92857142857143,192 Z"></path>
                                                    <path fill="#eee" class="recharts-sector recharts-radial-bar-background-sector" d="M 46.07142857142857,192A 86.42857142857143,86.42857142857143,0,0,1,218.92857142857144,192L 208.92857142857144,192A 76.42857142857143,76.42857142857143,0,0,0,56.07142857142857,192 Z"></path>
                                                    <path fill="#eee" class="recharts-sector recharts-radial-bar-background-sector" d="M 63.21428571428572,192A 69.28571428571428,69.28571428571428,0,0,1,201.78571428571428,192L 191.78571428571428,192A 59.285714285714285,59.285714285714285,0,0,0,73.21428571428572,192 Z"></path>
                                                </g>
                                                <g class="recharts-layer recharts-radial-bar-sectors">
                                                    <path fill="#E94B3CFF" class="recharts-sector recharts-radial-bar-sector" d="M 11.785714285714292,191.99999999999997A 120.71428571428571,120.71428571428571,0,0,1,159.74953237466707,74.40152313540717L 157.4921746631562,84.14340879282906A 110.71428571428571,110.71428571428571,0,0,0,21.785714285714292,192 Z"></path>
                                                    <path fill="#006B38FF" class="recharts-sector recharts-radial-bar-sector" d="M 28.92857142857143,192A 103.57142857142857,103.57142857142857,0,0,1,130.1061526165944,88.45623963255201L 130.33728270878527,98.45356821975389A 93.57142857142857,93.57142857142857,0,0,0,38.92857142857143,192 Z"></path>
                                                    <path fill="#00539CFF" class="recharts-sector recharts-radial-bar-sector" d="M 46.07142857142857,192A 86.42857142857143,86.42857142857143,0,0,1,108.83849882241476,108.87340184269054L 111.57619317354033,118.49135534849493A 76.42857142857143,76.42857142857143,0,0,0,56.07142857142857,192 Z"></path>
                                                    <path fill="#FFD662FF" class="recharts-sector recharts-radial-bar-sector" d="M 63.21428571428572,192A 69.28571428571428,69.28571428571428,0,0,1,112.73673879738168,125.59274353868614L 115.58916824930597,135.17729601763864A 59.285714285714285,59.285714285714285,0,0,0,73.21428571428572,192 Z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <div class="recharts-legend-wrapper" style="position: absolute; width: 265px; height: auto; left: 0px; bottom: 0px;">
                                            <div class="MuiGrid-root MuiGrid-container MuiGrid-align-items-xs-center MuiGrid-justify-xs-center">
                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-auto">
                                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 15px; color: #E94B3CFF;">
                                                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
                                                    </svg>
                                                    no review
                                                </div>
                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-auto">
                                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 15px; color: #006B38FF;">
                                                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
                                                    </svg>
                                                    Commercial
                                                </div>
                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-auto">
                                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 15px; color: #00539CFF;">
                                                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
                                                    </svg>
                                                    RESIDENTIAL
                                                </div>
                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-auto">
                                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 15px; color: #FFD662FF;">
                                                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
                                                    </svg>
                                                    Door Install
                                                </div>
                                            </div>
                                        </div>
                                        <div class="recharts-tooltip-wrapper" style="pointer-events: none; visibility: hidden; position: absolute; top: 0px; transform: translate(10px, 10px);">
                                            <div class="recharts-default-tooltip" style="margin: 0px; padding: 10px; background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); white-space: nowrap;">
                                                <p class="recharts-tooltip-label" style="margin: 0px;"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                        <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; left: 0px; top: 0px; width: 258px; height: 249px;"></div>
                                        </div>
                                        <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; left: 0px; top: 0px; width: 200%; height: 200%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                
                
            </div>
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
    <!-- page wrapper end -->
</div>
</div>
</div>

<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
    <div class="mdc-bottom-navigation">
        <nav class="mdc-bottom-navigation__list">
            <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
            <span class="material-icons mdc-bottom-navigation__list-item__icon">History</span>
            <span class="mdc-bottom-navigation__list-item__text">Recents</span>
            </span>
            <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
            <span class="material-icons mdc-bottom-navigation__list-item__icon">Favorite</span>
            <span class="mdc-bottom-navigation__list-item__text">Favorites</span>
            </span>
            <span class="sc-nearby mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                <span class="material-icons mdc-bottom-navigation__list-item__icon">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
                    </svg>
                </span>
                <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
            </span>
        </nav>
    </div>
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
    /* background-color: var(--mdc-theme-background, #fff); */
    width: 100%;
    box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    z-index: 8;
    }
    .hid-desk{
    display: none;
    }
    @media only screen and (max-width: 600px) {
    .hid-desk{
    display: block !important;
    }
    }
</style>
<!-- <ul id="sortable"> 
    <li class="ui-state-default" id="item_1"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li> 
    <li class="ui-state-default" id="item_2"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li> 
    <li class="ui-state-default" id="item_3"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li> 
    <li class="ui-state-default" id="item_4"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li> 
    <li class="ui-state-default" id="item_5"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li> 
    <li class="ui-state-default" id="item_6"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li> 
    <li class="ui-state-default" id="item_7"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li> 
</ul>  -->
<?php include viewPath('includes/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
    $('#onoff-customize').change(function() {
        if(this.checked) {
            $( ".sortable2" ).sortable( "enable" );
        }else{
            $( ".sortable2" ).sortable( "disable" );
        }

    });

    // $('#onoff-customize').click(function() {
    //     if(this.checked) {
    //         //var current = 1;
    //         // $( ".short_id" ).each(function( index ) {
    //         //     $('this').attr('id', 'item_'+current);
    //         //     current++;
    //         // });
    //         $("#sortable").sortable({
    //             stop: function(event, ui) {
    //                 console.log("New position: " + ui.item.index());
    //             },
    //             start: function(e, div) {
    //                 // creates a temporary attribute on the element with the old index
    //                 $(this).attr('data-previndex', div.item.index());
    //             },
    //             update: function(e, div) {
    //                 // gets the new and old index then removes the temporary attribute
    //                 var newIndex = div.item.index();
    //                 var oldIndex = $(this).attr('data-previndex');
    //                 var element_id = div.item.attr('id');
    //                 //alert('id of Item moved = '+element_id+' old position = '+oldIndex+' new position = '+newIndex);
    //                 $(this).removeAttr('data-previndex');
    //             }
    //         });
    //         $("#sortable").disableSelection();
    //     }else{
    //         $( "#sortable" ).sortable( "disable" );
    //         //$( "#sortable" ).disableSelection();
    //     }
    // });

    

    //$( ".sortable2" ).sortable( "enable" );
    $( ".sortable2" ).sortable({
       start: function(e, ui) {
           // creates a temporary attribute on the element with the old index
           $(this).attr('data-previndex', ui.item.index());
       },
       update: function(e, ui) {
           // gets the new and old index then removes the temporary attribute
           var newIndex = ui.item.index();
           var oldIndex = $(this).attr('data-previndex');
           var element_id = ui.item.attr('id');
           console.log('id of Item moved = '+element_id+' old position = '+oldIndex+' new position = '+newIndex);
           $(this).removeAttr('data-previndex');
           console.log("Module Changed!");
           var idsInOrder = $(".sortable2").sortable("toArray");
           console.log(idsInOrder);
           var new_module_sort="";
           for(var x=0;x<idsInOrder.length;x++){
               if(x===0){
                   if(idsInOrder[x] !== null){
                       new_module_sort = new_module_sort + idsInOrder[x];
                   }
               }else{
                   new_module_sort = new_module_sort +","+idsInOrder[x];
               }
              // console.log(idsInOrder[x]);
           }
           //console.log(new_module_sort);
           $.ajax({
               type: "POST",
               url: "/dashboard/ac_dashboard_sort",
               data: {ds_values : new_module_sort,acds_id : <?=  isset($dashboard_sort->acds_id) ? $dashboard_sort->acds_id : 0; ?> },  // serializes the form's elements.
               success: function(data)
               {
                   console.log(data);
               }
           });
       }
    });
    //$( ".sortable2" ).sortable( "disable" );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?= base_url()?>/assets/formbuilder/js/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
           $("#btn_select_existing_client").on( "click", function( event ) {
               $('#modal_customer').modal('show');
           });
           var table_cust_list =$('#customer_list_table').DataTable({
               "lengthChange": false,
               "searching" : true,
               "pageLength": 10,
               "info": true,
               "responsive": true,
               "order": [],
           });
    
    
        $('.floating-btn-div').hide();
        $('#shortcut_link').on('click', function(e){
            if ( $('.float1').is(':hidden') && $('.float2').is(':hidden') && $('.float3').is(':hidden') ){
                $('.floating-btn-div ').show('slow');
                $('.floating-btn-div ').show('slow');
                $('.floating-btn-div ').show('slow');
            }
            else{
                $('.floating-btn-div ').hide('slow');
                $('.floating-btn-div ').hide('slow');
                $('.floating-btn-div ').hide('slow');
            }
        });
    });
</script>
<!-- monthy graph -->
<script type="text/javascript">
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    datasets: [{
    label: '# of Votes',
    data: [12, 19, 3, 5, 2, 10],
    backgroundColor: [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)'
    ],
    borderColor: [
    'rgba(255,99,132,1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)'
    ],
    borderWidth: 1
    }]
    },
    options: {
    scales: {
    yAxes: [{
    ticks: {
    beginAtZero: true
    }
    }]
    }
    }
    });

    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
    labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
    datasets: [{
    data: [300, 50, 100, 40, 120],
    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
    }]
    },
    options: {
    responsive: true
    }
    });

    //polar
    // var ctxPA = document.getElementById("polarChart").getContext('2d');
    // var myPolarChart = new Chart(ctxPA, {
    // type: 'polarArea',
    // data: {
    // labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
    // datasets: [{
    // data: [300, 50, 100, 40, 120],
    // backgroundColor: ["rgba(219, 0, 0, 0.1)", "rgba(0, 165, 2, 0.1)", "rgba(255, 195, 15, 0.2)",
    // "rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.3)"
    // ],
    // hoverBackgroundColor: ["rgba(219, 0, 0, 0.2)", "rgba(0, 165, 2, 0.2)",
    // "rgba(255, 195, 15, 0.3)", "rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.4)"
    // ]
    // }]
    // },
    // options: {
    // responsive: true
    // }
    // });
    $(document).ready(function() {
    $('#myStatsTable').DataTable({
        "paging": false,
        "filter":false
    });
    } );
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="<?=base_url("assets/plugins/raphael/raphael.min.js")?>"></script>
<script src="<?=base_url("assets/plugins/morris.js/morris.min.js")?>"></script>
<script type="text/javascript">
    data = {
        datasets: [{
            data: [10, 20, 30, 40, 50],
            backgroundColor: [
                '#00B1D2FF',
                '#2C5F2DFF',
                '#4B878BFF',
                '#D01C1FFF',
                '#FDDB27FF',
              ],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Iphone',
            'Samsung',
            'Huawei',
            'General Mobile',
            'Xiaomi',
        ],
    };

    leadsource_data = {
        datasets: [{
            data: [10, 20, 30, 40, 50, 60],
            backgroundColor: [
                '#669DB3FF',
                '#FF4F58FF',
                '#DBB04AFF',
                '#97B3D0FF',
                '#008C76FF',
                '#9ED9CCFF',
              ],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Telemarketing',
            'Affinty',
            'Self Generating',
            'Social Networks',
            'Google Ads',
            'Referrals',
        ],
    };

    var ctx = document.getElementById('TagsChart').getContext('2d');
    var ctx1 = document.getElementById('LeadSourceChart').getContext('2d');

    // For a pie chart
    var myPieChart = new Chart(ctx1, {
        type: 'pie',
        data: leadsource_data,
        //options: options
    });
    // And for a doughnut chart
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        //options: options
    });

     $(document).ready(function () {
        // Donut Graph
        var Data = [
            {label:"Commissions & Fees",value:74},
            {label:"Reimburstment",value:19},
            {label:"Subcontractors",value:7},
            {label:"Bank Charges",value:2}
        ];
        var total = 100;
        var donut_chart = Morris.Donut({
            element: 'expensesChart',
            data:Data,
            resize:true,
            formatter: function (value, data) {
            return Math.floor(value/total*100) + '%';
            }
        });
    });

    $(function () {
        "use strict";
        // LINE CHART
        var data=[
            {"date":"Jun 14 - Jun 20","sales":"0"},
            {"date":"Jun 21 - Jun 27","sales":"0"},
            {"date":"Jun 28 - Jul 4","sales":"0"},
            {"date":"Jul 5 - Jul 11","sales":"4"},
            {"date":"Jul 12 - Jul 13","sales":"0"}
        ];

        Morris.Line({
            element: 'sales-line-chart',
            data: data,
            resize:true,
            xkey: ['date'],
            ykeys: ['sales'],
            ymax:12,
            labels: ['Sales'],
            preUnits:'$',
            parseTime : false
        });

    });
</script>