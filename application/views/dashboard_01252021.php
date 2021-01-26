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
                                    <span>Send a private message to particular user</span>
                                </div>
                            </div>
                        </a>
                        <br>
                        <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal2">
                            <div class="qUickStart">
                                <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">E</span>
                                <div class="qUickStartde">
                                    <h4>Add a News Letter</h4>
                                    <span>Send a company newslatter to all user</span>
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

        <div class="row d-none d-lg-flex sortable2 MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2" id="sortable">
            <?php
            include viewPath('dashboard/bulletin');
            ?>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3 short_id" id="item_1">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content" >
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss56">Upcoming jobs</span>
                                    </h6>
                                </span>
                            </div>
                            <div class="MuiCardHeader-action">
                                <span class="jss57">
                                    <a class="MuiButtonBase-root MuiIconButton-root" tabindex="0" aria-disabled="false" href="/pro/new_job">
                                        <span class="MuiIconButton-label">
                                            <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;">
                                                <path d="M21.117,17.975l-7.758-7.757c0.768-1.96,0.342-4.262-1.278-5.882C10.376,2.63,7.819,2.29,5.773,3.228l3.666,3.665 L6.881,9.45L3.13,5.785c-1.023,2.046-0.597,4.603,1.108,6.308c1.62,1.619,3.921,2.046,5.882,1.278l7.758,7.758 c0.341,0.34,0.853,0.34,1.193,0l1.96-1.961C21.458,18.827,21.458,18.23,21.117,17.975z"></path>
                                                <path d="M6,18v-3H4v3H1v2h3v3h2v-3h3v-2H6z"></path>
                                            </svg>
                                        </span>
                                        <span class="MuiTouchRipple-root"></span>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 260px;">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">
                                    <a class="MuiButtonBase-root MuiButton-root jss107 MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="job/new_job?job_num=1000">
                                        <span class="MuiButton-label">
                                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                <?php $jobCounter=0;?>
                                                <?php foreach($job as $jb) : ?>
                                                <?php if(check_upcoming_date($jb->created_date)): ?>
                                                <?php $jobCounter++;?>
                                                <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="margin-bottom: 5px;"><?php echo get_format_date_with_day($jb->created_date); ?></h6>
                                                <div class="MuiGrid-root MuiGrid-container">
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3" style="padding-right: 8px;">
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo get_format_time($jb->created_date); ?></h6>
                                                        <div class="MuiGrid-root MuiGrid-container" style="margin-top: 5px; margin-bottom: 5px;">
                                                            <div class="MuiGrid-root jss110 MuiGrid-item MuiGrid-grid-xs-12">
                                                                <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap MuiTypography-alignCenter" style="color: rgb(33, 150, 243);"><?php echo strtoupper($jb->status); ?></div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap">Arrival window:</div>
                                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap"><?php echo get_format_time($jb->created_date); ?>-<?php echo get_format_time_plus_hours($jb->created_date); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-7" style="border-left: 0.1em solid rgb(234, 234, 234); padding-left: 8px;">
                                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo strtoupper($jb->job_name); ?> </h6>
                                                        <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"><?php echo get_customer_by_id($jb->customer_id); ?></p>
                                                        <div>
                                                            <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"><?php echo strtoupper($jb->job_location); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1" style="margin-left: 5px; display: flex; justify-content: center;">
                                                        <div class="MuiAvatar-root MuiAvatar-circle" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                                            <img alt="Garrett Rickman" src="assets/img/customer_sm.png" class="MuiAvatar-img">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php if($jobCounter == 0) : ?>
                                                <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700; margin: auto; padding-top: 100px;">NO JOBS YET</h6>
                                                <?php endif; ?>
                                            </div>
                                        </span>
                                        <span class="MuiTouchRipple-root"></span>
                                    </a>
                                </div>
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                    <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                                </div>
                            </div>
                        </div>
                        <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                            <div style="margin: auto;">
                                <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="<?php echo url('job') ?>">
                                <?php if($jobCounter > 0) : ?>
                                <span class="MuiButton-label">SEE ALL JOBS</span>
                                <?php endif; ?>
                                <span class="MuiTouchRipple-root"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3 short_id" id="item_2">
                    <div class="c65 c61">
                        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                                <div class="MuiCardHeader-avatar">
                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                        <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                                    </svg>
                                </div>
                                <div class="MuiCardHeader-content">
                                    <span class="">
                                        <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                            <span class="jss55 jss62">Open estimates</span>
                                        </h6>
                                    </span>
                                </div>
                                <div class="MuiCardHeader-action">
                                    <span title="Add estimate" class="jss57">
                                        <a class="MuiButtonBase-root MuiIconButton-root" tabindex="0" aria-disabled="false" href="/pro/new_estimate">
                                            <span class="MuiIconButton-label">
                                                <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px;">
                                                    <path d="M6,18v-3H4v3H1v2h3v3h2v-3h3v-2H6z"></path>
                                                    <g>
                                                        <path d="M19.001,2.939h-4.179c-0.42-1.087-1.519-1.875-2.819-1.875c-1.299,0-2.399,0.787-2.819,1.875H5.004c-1.1,0-2,0.844-2,1.875 V13h2V4.813h2v2.812h9.997V4.813h2v14.997H11v1.875h8.001c1.099,0,1.999-0.844,1.999-1.875V4.813C21,3.783,20.1,2.939,19.001,2.939 z M12.003,4.813c-0.549,0-1-0.422-1-0.937c0-0.516,0.451-0.938,1-0.938c0.551,0,0.999,0.422,0.999,0.938 C13.002,4.392,12.554,4.813,12.003,4.813z"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span class="MuiTouchRipple-root"></span>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                            <div class="MuiCardContent-root jss60" style="height: 260px;">
                                <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">
                                        <?php $estCounter=0;?>
                                        <?php foreach($estimate as $est) : ?>
                                        <?php if ($estCounter < 2) : ?>
                                        <?php $estCounter++;?>
                                        <a class="MuiButtonBase-root MuiButton-root jss107 MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="/pro/estimates/new/60749141">
                                            <span class="MuiButton-label">
                                                <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                    <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="margin-bottom: 5px;"><?php echo get_format_date_with_day($est->estimate_date); ?></h6>
                                                    <div class="MuiGrid-root MuiGrid-container">
                                                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-3" style="padding-right: 8px;">
                                                            <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo get_format_time($est->created_at); ?></h6>
                                                            <div class="MuiGrid-root MuiGrid-container" style="margin-top: 5px; margin-bottom: 5px;">
                                                                <div class="MuiGrid-root jss110 MuiGrid-item MuiGrid-grid-xs-12">
                                                                    <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap MuiTypography-alignCenter" style="color: rgb(33, 150, 243);"><?php echo strtoupper($est->status); ?></div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap">Arrival window:</div>
                                                                <div class="MuiTypography-root MuiTypography-caption MuiTypography-noWrap"><?php echo get_format_time($est->created_at); ?>-<?php echo get_format_time_plus_hours($est->created_at); ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-7" style="border-left: 0.1em solid rgb(234, 234, 234); padding-left: 8px;">
                                                            <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700;"><?php echo strtoupper($est->job_name); ?> </h6>
                                                            <!-- <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"><?php //echo get_customer_by_id($est->customer_id); ?></p> -->
                                                            <div>
                                                                <p class="MuiTypography-root jss109 MuiTypography-body1 MuiTypography-noWrap"> <?php echo strtoupper($est->job_location); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-1" style="margin-left: 5px; display: flex; justify-content: center;">
                                                            <div class="MuiAvatar-root MuiAvatar-circle" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                                                <img alt="Robert Leo" src="assets/img/customer_sm.png" class="MuiAvatar-img">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                            <span class="MuiTouchRipple-root"></span>
                                        </a>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if($estCounter == 0) : ?>
                                        <h6 class="MuiTypography-root jss111 MuiTypography-subtitle1 MuiTypography-noWrap" style="font-weight: 700; margin: auto; padding-top: 100px;">NO ESTIMATES YET</h6>
                                        <?php endif; ?>
                                    </div>
                                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                                <div style="margin: auto;">
                                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="estimate">
                                    <?php if($estCounter > 0) : ?>
                                    <span class="MuiButton-label">SEE ALL ESTIMATES</span>
                                    <?php endif; ?>
                                    <span class="MuiTouchRipple-root"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_7">
                    <div class="c65 c61">
                        <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: pointer; width: 100%; position: relative;">
                            <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                                <div class="MuiCardHeader-avatar">
                                    <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                        <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"></path>
                                    </svg>
                                </div>
                                <div class="MuiCardHeader-content">
                                    <span class="">
                                        <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                            <span class="jss55 jss92">Jobs</span>
                                        </h6>
                                    </span>
                                </div>
                                <div class="MuiCardHeader-action">
                                    <span title="View &amp; configure report" class="jss57"></span>
                                </div>
                            </div>
                            <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                            <div class="MuiCardContent-root jss60" style="height: 309px;">
                                <div>
                                    <div class="c65 c83" style="text-align: center;">
                                        <div class="c66 c92">
                                            <p class="c162 c171 c187">$0</p>
                                        </div>
                                        <div class="c66 c92"></div>
                                        <div class="c66 c92">
                                            <p class="c162 c171 c187 c188">$0</p>
                                        </div>
                                        <div class="c66 c92">
                                            <p class="c162 c171 c187 c188">$0</p>
                                        </div>
                                        <div class="c66 c92"
                                            ><span class="c162 c172">0 complete</span>
                                        </div>
                                        <div class="c66 c92">
                                            <span class="c162 c172 c188">All Time</span>
                                        </div>
                                        <div class="c66 c92">
                                            <span class="c162 c172 c188">0 sched</span>
                                        </div>
                                        <div class="c66 c92">
                                            <span class="c162 c172 c188">0 unsched</span>
                                        </div>
                                        <div class="c66 c101">
                                            <div>
                                                <div style="height: 10px; width: 1px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recharts-responsive-container" style="width: 100%; height: 255px; position: relative;">
                                        <div class="recharts-wrapper" style="position: relative; cursor: default; width: 265px; height: 255px;">
                                            <svg class="recharts-surface" width="265" height="255" viewBox="0 0 265 255" version="1.1">
                                                <g class="recharts-cartesian-grid">
                                                    <g class="recharts-cartesian-grid-horizontal">
                                                        <line stroke="#EFEFEF" x="40" y="10" width="165" height="171" fill="none" x1="40" y1="181" x2="205" y2="181"></line>
                                                        <line stroke="#EFEFEF" x="40" y="10" width="165" height="171" fill="none" x1="40" y1="138.25" x2="205" y2="138.25"></line>
                                                        <line stroke="#EFEFEF" x="40" y="10" width="165" height="171" fill="none" x1="40" y1="95.5" x2="205" y2="95.5"></line>
                                                        <line stroke="#EFEFEF" x="40" y="10" width="165" height="171" fill="none" x1="40" y1="52.75" x2="205" y2="52.75"></line>
                                                        <line stroke="#EFEFEF" x="40" y="10" width="165" height="171" fill="none" x1="40" y1="10" x2="205" y2="10"></line>
                                                    </g>
                                                </g>
                                                <g class="recharts-layer recharts-x-axis">
                                                    <g class="recharts-layer recharts-cartesian-axis">
                                                        <line class="recharts-cartesian-axis-line" width="165" height="30" x="40" y="181" stroke="#666" fill="none" x1="40" y1="181" x2="205" y2="181"></line>
                                                        <g class="recharts-cartesian-axis-ticks">
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text width="165" height="30" x="72.5" y="187" stroke="none" fill="#666" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                                                    <tspan x="72.5" dy="0.71em">2018</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text width="165" height="30" x="122.5" y="187" stroke="none" fill="#666" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                                                    <tspan x="122.5" dy="0.71em">2020</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text width="165" height="30" x="172.5" y="187" stroke="none" fill="#666" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle">
                                                                    <tspan x="172.5" dy="0.71em">2022</tspan>
                                                                </text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g class="recharts-layer recharts-y-axis">
                                                    <g class="recharts-layer recharts-cartesian-axis">
                                                        <g class="recharts-cartesian-axis-ticks">
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="34" y="181" fill="#4A4A4A" color="#69F0AE" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                                                    <tspan x="34" dy="0.355em">0</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="34" y="138.25" fill="#4A4A4A" color="#69F0AE" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                                                    <tspan x="34" dy="0.355em">300</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="34" y="95.5" fill="#4A4A4A" color="#69F0AE" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                                                    <tspan x="34" dy="0.355em">600</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="34" y="52.75" fill="#4A4A4A" color="#69F0AE" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                                                    <tspan x="34" dy="0.355em">900</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="34" y="10" fill="#4A4A4A" color="#69F0AE" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="end">
                                                                    <tspan x="34" dy="0.355em">1200</tspan>
                                                                </text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g class="recharts-layer recharts-cartesian-axis">
                                                        <g class="recharts-cartesian-axis-ticks">
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="211" y="181" fill="#4A4A4A" color="#1976D2" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="start">
                                                                    <tspan x="211" dy="0.355em">$0</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="211" y="138.25" fill="#4A4A4A" color="#1976D2" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="start">
                                                                    <tspan x="211" dy="0.355em">$200,000</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="211" y="95.5" fill="#4A4A4A" color="#1976D2" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="start">
                                                                    <tspan x="211" dy="0.355em">$400,000</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="211" y="52.75" fill="#4A4A4A" color="#1976D2" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="start">
                                                                    <tspan x="211" dy="0.355em">$600,000</tspan>
                                                                </text>
                                                            </g>
                                                            <g class="recharts-layer recharts-cartesian-axis-tick">
                                                                <text stroke="none" width="60" height="171" x="211" y="10" fill="#4A4A4A" color="#1976D2" font-size="10px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="start">
                                                                    <tspan x="211" dy="0.355em">$800,000</tspan>
                                                                </text>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g class="recharts-layer recharts-composed">
                                                    <g class="recharts-layer recharts-area-graphical">
                                                        <g class="recharts-layer recharts-area-chart-group">
                                                            <g class="recharts-layer recharts-area-chart-shapes">
                                                                <g class="recharts-layer recharts-area">
                                                                    <defs>
                                                                        <clipPath id="animationClipPath-recharts-area-7">
                                                                            <rect x="72.5" y="0" width="100" height="1813"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                    <g class="recharts-layer">
                                                                        <g class="recharts-layer" clip-path="url(#animationClipPath-recharts-area-7)">
                                                                            <g>
                                                                                <path fill="none" stroke="#69F0AE" stroke-width="3" fill-opacity="0.6" width="165" height="171" class="recharts-curve recharts-area-curve" d="M72.5,16.555000000000007C80.83333333333333,62.5825,89.16666666666667,108.61,97.5,108.61C105.83333333333333,108.61,114.16666666666667,40.922499999999985,122.5,40.922499999999985C130.83333333333334,40.922499999999985,139.16666666666666,180.0025,147.5,180.2875C155.83333333333334,180.5725,164.16666666666666,180.64375,172.5,180.715"></path>
                                                                                <path fill="#cbffe6" stroke="none" stroke-width="3" fill-opacity="0.6" width="165" height="171" class="recharts-curve recharts-area-area" d="M72.5,16.555000000000007C80.83333333333333,62.5825,89.16666666666667,108.61,97.5,108.61C105.83333333333333,108.61,114.16666666666667,40.922499999999985,122.5,40.922499999999985C130.83333333333334,40.922499999999985,139.16666666666666,180.0025,147.5,180.2875C155.83333333333334,180.5725,164.16666666666666,180.64375,172.5,180.715L172.5,181C164.16666666666666,181,155.83333333333334,181,147.5,181C139.16666666666666,181,130.83333333333334,181,122.5,181C114.16666666666667,181,105.83333333333333,181,97.5,181C89.16666666666667,181,80.83333333333333,181,72.5,181Z"></path>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <g class="recharts-layer recharts-area-chart-dots"></g>
                                                        </g>
                                                    </g>
                                                    <g class="recharts-layer recharts-bar-graphical">
                                                        <g class="recharts-layer recharts-bar">
                                                            <g class="recharts-layer recharts-bar-rectangles">
                                                                <g class="recharts-layer recharts-bar-rectangle" style="transform-origin: 72.5px 181px 0px; transform: scaleY(1); transition: transform 1500ms ease 0s;">
                                                                    <path fill="#1976D2" width="20" height="151.5749236875" x="62.5" y="29.42507631250001" class="recharts-rectangle" d="M 62.5,29.42507631250001 h 20 v 0 h -20 Z"></path>
                                                                </g>
                                                                <g class="recharts-layer recharts-bar-rectangle" style="transform-origin: 97.5px 181px 0px; transform: scaleY(1); transition: transform 1500ms ease 0s;">
                                                                    <path fill="#1976D2" width="20" height="145.9115746875" x="87.5" y="35.08842531249999" class="recharts-rectangle" d="M 87.5,35.08842531249999 h 20 v 0 h -20 Z"></path>
                                                                </g>
                                                                <g class="recharts-layer recharts-bar-rectangle" style="transform-origin: 122.5px 181px 0px; transform: scaleY(1); transition: transform 1500ms ease 0s;">
                                                                    <path fill="#1976D2" width="20" height="160.7571619875" x="112.5" y="20.242838012499988" class="recharts-rectangle" d="M 112.5,20.242838012499988 h 20 v 0 h -20 Z"></path>
                                                                </g>
                                                                <g class="recharts-layer recharts-bar-rectangle" style="transform-origin: 147.5px 181px 0px; transform: scaleY(1); transition: transform 1500ms ease 0s;">
                                                                    <path fill="#1976D2" width="20" height="0" x="137.5" y="181" class="recharts-rectangle" d="M 137.5,181 h 20 v 0 h -20 Z"></path>
                                                                </g>
                                                                <g class="recharts-layer recharts-bar-rectangle" style="transform-origin: 172.5px 181px 0px; transform: scaleY(1); transition: transform 1500ms ease 0s;">
                                                                    <path fill="#1976D2" width="20" height="0" x="162.5" y="181" class="recharts-rectangle" d="M 162.5,181 h 20 v 0 h -20 Z"></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <div class="recharts-legend-wrapper" style="position: absolute; width: 285px; height: 36px; left: -20px; bottom: 8px;">
                                                <ul class="recharts-default-legend" style="padding: 0px; margin: 0px; text-align: center;">
                                                    <li class="recharts-legend-item legend-item-0" style="display: inline-block; margin-right: 10px;">
                                                        <svg class="recharts-surface" width="14" height="14" style="display: inline-block; vertical-align: middle; margin-right: 4px;" viewBox="0 0 32 32" version="1.1">
                                                            <path stroke-width="4" fill="none" stroke="#69F0AE" d="M0,16h10.666666666666666A5.333333333333333,5.333333333333333,0,1,1,21.333333333333332,16H32M21.333333333333332,16A5.333333333333333,5.333333333333333,0,1,1,10.666666666666666,16" class="recharts-legend-icon"></path>
                                                        </svg>
                                                        <span class="recharts-legend-item-text">Job count</span>
                                                    </li>
                                                    <li class="recharts-legend-item legend-item-1" style="display: inline-block; margin-right: 10px;">
                                                        <svg class="recharts-surface" width="14" height="14" style="display: inline-block; vertical-align: middle; margin-right: 4px;" viewBox="0 0 32 32" version="1.1">
                                                            <path stroke="none" fill="#1976D2" d="M0,4h32v24h-32z" class="recharts-legend-icon"></path>
                                                        </svg>
                                                        <span class="recharts-legend-item-text">Job value</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="recharts-tooltip-wrapper" style="pointer-events: none; visibility: hidden; position: absolute; top: 0px; transform: translate(40px, 10px);">
                                                <div class="recharts-default-tooltip" style="margin: 0px; padding: 10px; background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); white-space: nowrap;">
                                                    <p class="recharts-tooltip-label" style="margin: 0px; font-size: 13px;"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                            <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                                <div style="position: absolute; left: 0px; top: 0px; width: 258px; height: 248px;"></div>
                                            </div>
                                            <div style="position: absolute; inset: 0px; overflow: scroll; z-index: -1; visibility: hidden;">
                                                <div style="position: absolute; left: 0px; top: 0px; width: 200%; height: 200%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-sm-4 db-card" id="installs">
                <div class="expenses tile-container" style="height: 354px;">
                    <div class="inner-container">
                        <div class="tileContent">
                            <div class="clear">
                                <div class="inner-content">
                                    <div class="header-container" style="border-bottom:1px solid gray;">
                                        <h3 class="header-content"><i class="fa fa-list" aria-hidden="true"></i> Sales Leaderboard</h3>
                                    </div>
                                    <div class="expenses-money-section">
                                        <div class="top-ins-in">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="insl-bx">
                                                        <h5>Top Reps</h5>

                                                        <ul>
                                                            <li><strong>1.</strong> T.Smith (COR) - <span>133</span></li>
                                                            <li><strong>2.</strong> T.Smith (COR) - <span>133</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="insl-bx">
                                                        <h5>Top Techs</h5>

                                                        <ul>
                                                            <li><strong>1.</strong> T.Smith (COR) - <span>133</span></li>
                                                            <li><strong>2.</strong> T.Smith (COR) - <span>133</span></li>
                                                            <li><strong>3.</strong> T.Smith (COR) - <span>133</span></li>
                                                            <li><strong>4.</strong> T.Smith (COR) - <span>133</span></li>
                                                            <li><strong>5.</strong> T.Smith (COR) - <span>133</span></li>
                                                            <li><strong>6.</strong> T.Smith (COR) - <span>133</span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer view-all-bx">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_9">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss99">Sales leaderboard</span>
                                    </h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="text-align: center;">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">All Time</h6>
                                </div>
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                    <?php $empCounter=0;?>
                                    <?php foreach($users as $emp): ?>
                                    <?php if($empCounter < 4): ?>
                                    <?php $empCounter++;?>
                                    <div class="MuiGrid-root MuiGrid-container MuiGrid-align-items-xs-center">
                                        <div class="MuiGrid-root jss96 MuiGrid-item MuiGrid-grid-xs-9">
                                            <div class="MuiAvatar-root MuiAvatar-circle jss94" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                                <img src="<?php echo userProfileImage($emp->id) ?>" alt="user" class="rounded-circle" style="height: 50px;">
                                            </div>
                                            <div style="width: 99.9829%;" class="jss97">
                                                <p class="MuiTypography-root jss98 MuiTypography-body1">$0</p>
                                            </div>
                                        </div>
                                        <div class="MuiGrid-root jss95 MuiGrid-item MuiGrid-grid-xs-3">0 jobs</div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_9">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss99">Tech leaderboard</span>
                                    </h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="text-align: center;">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">All Time</h6>
                                </div>
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                    <?php $empCounter=0;?>
                                    <?php foreach($users as $emp): ?>
                                    <?php if($empCounter < 4): ?>
                                    <?php $empCounter++;?>
                                    <div class="MuiGrid-root MuiGrid-container MuiGrid-align-items-xs-center">
                                        <div class="MuiGrid-root jss96 MuiGrid-item MuiGrid-grid-xs-9">
                                            <div class="MuiAvatar-root MuiAvatar-circle jss94" style="border: 2px solid transparent; border-radius: 50%; width: 40px; height: 40px;">
                                                <img src="<?php echo userProfileImage($emp->id) ?>" alt="user" class="rounded-circle" style="height: 50px;">
                                            </div>
                                            <div style="width: 99.9829%;" class="jss97">
                                                <p class="MuiTypography-root jss98 MuiTypography-body1">$0</p>
                                            </div>
                                        </div>
                                        <div class="MuiGrid-root jss95 MuiGrid-item MuiGrid-grid-xs-3">0 jobs</div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_12">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Tags</span></h6>
                                </span>
                            </div>
                            <div class="MuiCardHeader-action" style="margin-top:5px;">
                                <span title="Create Tags" class="jss55 jss93"><a href="javascript:void(0)" class="card-link text-success" data-toggle="modal" data-target="#exampleModal3">Create Tags</a></span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="jss87">
                                <canvas id="TagsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_13">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;height: 395px;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Lead Source</span></h6>
                                </span>
                            </div>
                            <div class="header-separator">
                                <div class="hs-content">
                                    <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                        <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                            Name of Lead Source&nbsp;<span class="fa fa-caret-down"></span></span>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" class="dropdown-item">Name of Lead Source</a></li>
                                            <li><a href="#" class="dropdown-item">Current Number of Jobs From Lead Source</a></li>
                                            <li><a href="#" class="dropdown-item">Last month</a></li>
                                            <li><a href="#" class="dropdown-item">Last year</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="jss87">
                                <canvas id="LeadSourceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3">
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
                                        <span class="jss55 jss56">Activity</span>
                                    </h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px; overflow-x:scroll">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 30px;">
                                    <ul class="timeline">
                                        <?php 
                                        if(!empty($activity_list))
                                        {
                                        foreach($activity_list as $al) { ?>
                                            <li class="timeline-item">
                                                <p class="timeline-content"><?=$al['activity']?></p>
                                                <p class="event-time"><?=$al['createdAt']?></p>
                                            </li>
                                        <?php } 
                                        }?>
                                    </ul>
                                </div>
                               
                            </div>
                        </div>
                        <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                            <div style="margin: auto;">
                                <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="customer#settings">
                                <?php if($activity_list_count > 5) {?> 
                                    <span class="MuiButton-label">Load More</span>
                                    <span class="MuiTouchRipple-root"></span>
                                <?php } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss56">History</span>
                                    </h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px; overflow-x:scroll">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 30px;">
                                    <ul class="timeline">
                                        <?php 
                                        if(!empty($history_activity_list))
                                        {
                                            foreach($history_activity_list as $al) { ?>
                                                <li class="timeline-item">
                                                    <p class="timeline-content"><?=$al['activity']?></p>
                                                    <p class="event-time"><?=$al['createdAt']?></p>
                                                </li>
                                            <?php }
                                        } 
                                        ?>
                                    </ul>
                                </div>
                               
                            </div>
                        </div>
                        <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                            <div style="margin: auto;">
                                <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false">
                                <?php if($history_activity_list_count > 5) {?> 
                                    <span class="MuiButton-label">Load More</span>
                                    <span class="MuiTouchRipple-root"></span>
                                <?php } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_6">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss91">Today's stats</span>
                                    </h6>
                                </span>
                            </div>
                            <div class="MuiCardHeader-action">
                                <span title="Today" class="jss57"></span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px; overflow-x:scroll">
                            <div class="jss87">
                                <div class="MuiGrid-root jss88 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Earned</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>$0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Collected</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>$0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Jobs completed</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>4</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiGrid-root jss89 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">New jobs booked online</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>$0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Total new jobs booked</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>$0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Lost Accounts</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>$0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Collections</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169">
                                                    <span>$0</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_11">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Taskhub stats</span></h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px; overflow-x:scroll">
                            <div class="jss87">
                                <div class="MuiGrid-root jss88 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">All Tasks</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$all_tasks;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">My Assigned Tasks</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$my_assig_tasks;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiGrid-root jss89 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                    <div class="c66">
                                        <?php 
                                            if(count($status_arr) > 0)
                                            {
                                                foreach ($status_arr as $status_array) 
                                                {
                                                    $exp_status_array = explode("@#@", $status_array);
                                                    ?>
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171"><?=ucwords($exp_status_array[0]);?> Tasks</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$exp_status_array[1];?></span></h3>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                            }
                                            ?>
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Due Today Tasks</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$due_today_tasks;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss56">Tasks</span>
                                    </h6>
                                </span>
                            </div>
                            <div class="msg-count-cus badge badge-pill badge-info ml-auto px-1 py-1 mr-1">
                                8
                            </div>
                            <div class="msg-count-cus badge badge-pill badge-warning ml-auto px-1 py-1 mr-1">
                                2
                            </div>
                            <div class="msg-count-cus badge badge-pill badge-success ml-auto px-1 py-1">
                                +
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">

                                    <div class="message-box position-relative">
                                        <div class="message-widget contact-widget position-relative">

                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">S</span>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="text-truncate mb-0">Send Invoice</h5>
                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 2 days delays</span>
                                                </div>
                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                </div>
                                            </a>

                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">P</span>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="text-truncate mb-0">Pay Bill (Re: Adam Dee)</h5>
                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 2 days delays</span>
                                                </div>
                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                </div>
                                            </a>

                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-info msg-count-cus">N</span>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="text-truncate mb-0">New York Conference</h5>
                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 10 days left</span>
                                                </div>
                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                </div>
                                            </a>

                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-info msg-count-cus">I</span>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="text-truncate mb-0">Interview Maria</h5>
                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 12 days left</span>
                                                </div>
                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                </div>
                                            </a>

                                        </div>
                                    </div>

                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="income tile-container">
                    <div class="inner-container">
                        <div class="tileContent">
                            <div class="clear">
                                <div class="inner-content">
                                    <div class="header-container">
                                        <h3 class="header-content">Income</h3>
                                        <div class="header-separator">
                                            <div class="hs-content">Last 365 Days</div>
                                        </div>
                                    </div>
                                    <div class="con-inner-container">
                                        <div class="con-bar">
                                            <div class="open-invoices box-invoices-bar"></div>
                                            <div class="paid-invoices box-invoices-bar"></div>
                                        </div>
                                        <div class="con-data-label">
                                            <div class="con-label">3</div>
                                            <div class="con-sub-label">Open invoices</div>
                                            <div class="con-label">0</div>
                                            <div class="con-sub-label">Overdue invoices</div>
                                            <div class="con-label">0</div>
                                            <div class="con-sub-label">Paid last 30 days</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="expenses tile-container">
                    <div class="inner-container">
                        <div class="tileContent">
                            <div class="clear">
                                <div class="inner-content">
                                    <div class="header-container">
                                        <h3 class="header-content">Expenses</h3>
                                        <div class="header-separator">
                                            <div class="hs-content">
                                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                    <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                        Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                                                        <li><a href="#" class="dropdown-item">This month</a></li>
                                                        <li><a href="#" class="dropdown-item">This quarter</a></li>
                                                        <li><a href="#" class="dropdown-item">This year</a></li>
                                                        <li><a href="#" class="dropdown-item">Last month</a></li>
                                                        <li><a href="#" class="dropdown-item">Last quarter</a></li>
                                                        <li><a href="#" class="dropdown-item">Last year</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expenses-money-section">
                                        <div class="expenses-money-data">$4,247</div>
                                        <div class="expenses-con-data">This month</div>
                                    </div>
                                    <div class="expenses-donutchart-section">
                                        <div class="donut-chart-container">
                                           <div id="expensesChart" style="width: 150px;height: 170px;"></div>
                                            <div id="legendExpenses">
                                                <div class="legendList">
                                                    <div class="box"></div>
                                                    <div class="amount">74%</div>
                                                    <div class="name">Commission & fees</div>
                                                    <div class="box" style="background: #3980b5;"></div>
                                                    <div class="amount">19%</div>
                                                    <div class="name">Reimburtment</div>
                                                    <div class="box" style="background: #95bbd7;"></div>
                                                    <div class="amount">7%</div>
                                                    <div class="name">Subcontractors</div>
                                                    <div class="box" style="background: #caddeb;"></div>
                                                    <div class="amount">2%</div>
                                                    <div class="name">Bank Charges</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="bank-accounts tile-container">
                    <div class="inner-container">
                        <div class="tileContent">
                            <div class="clear">
                                <div class="inner-content">
                                    <div class="header-container">
                                        <h3 class="header-content">Bank Accounts</h3>
                                        <a href="" style="float: right;"><i class="fa fa-pencil fa-lg"></i></a>
                                        <div class="header-separator">
                                            <div class="hs-content">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bankList" style="height: 189px;overflow:scroll;">
                                        <div class="dgrid-row connectedAccount">
                                            <div class="bankAccountRowLink bankAccountRow">
                                                <div class="bankRow">
                                                    <div class="bankRowHeader">
                                                        <div class="qboNameHeader">
                                                            <div class="qboName">Corporate Account (XXXXXX 5850)</div>
                                                        </div>
                                                        <div class="headerMessage">
                                                            <div class="pendingTxns">11 to review</div>
                                                        </div>
                                                    </div>
                                                    <div class="bankRowDetail">
                                                        <div class="description">
                                                            <div class="balanceDescription">Bank balance</div>
                                                            <div class="nsBalanceDescription">In nSmartrac</div>
                                                        </div>
                                                        <div class="accountDetails">
                                                            <div class="balance">
                                                                <div class="bankBalance">$5,741.11</div>
                                                                <div class="nsBalance">$-7,049.40</div>
                                                            </div>
                                                            <div class="count">
                                                                <div class="lastUpdated line-clamp">Updated 1 day ago</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dgrid-row">
                                            <div class="bankAccountRowLink bankAccountRow">
                                                <div class="bankRow">
                                                    <div class="bankRowHeader">
                                                        <div class="qboNameHeader">
                                                            <div class="qboName">Cash on hand</div>
                                                        </div>
                                                        <div class="headerMessage">
                                                            <div class="pendingTxns"></div>
                                                        </div>
                                                    </div>
                                                    <div class="bankRowDetail">
                                                        <div class="description">
                                                            <div class="nsBalanceDescription">In nSmartrac</div>
                                                        </div>
                                                        <div class="accountDetails">
                                                            <div class="count">
                                                                <div class="bankBalance" style="display: none">$0</div>
                                                                <div class="nsBalance">$111,101.00</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dgrid-row">
                                            <div class="bankAccountRowLink bankAccountRow">
                                                <div class="bankRow">
                                                    <div class="bankRowHeader">
                                                        <div class="qboNameHeader">
                                                            <div class="qboName">Corporate Account (XXXXXX 5850)Te</div>
                                                        </div>
                                                        <div class="headerMessage">
                                                            <div class="pendingTxns"></div>
                                                        </div>
                                                    </div>
                                                    <div class="bankRowDetail">
                                                        <div class="description">
                                                            <div class="nsBalanceDescription">In nSmartrac</div>
                                                        </div>
                                                        <div class="accountDetails">
                                                            <div class="count">
                                                                <div class="bankBalance" style="display: none">$0</div>
                                                                <div class="nsBalance">$0</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="addFISection">
                                        <a href="#">Connect accounts</a>
                                        <div class="registerLink">
                                            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                    <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                        Go to register&nbsp;<span class="fa fa-caret-down"></span></span>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)</a></li>
                                                    <li><a href="#" class="dropdown-item">Cash on hand</a></li>
                                                    <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)Te</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="sales tile-container" >
                    <div class="inner-container">
                        <div class="tileContent">
                            <div class="clear">
                                <div class="inner-content">
                                    <div class="header-container">
                                        <h3 class="header-content">Sales</h3>
                                        <div class="header-separator">
                                            <div class="hs-content">
                                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                    <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                        Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                                                        <li><a href="#" class="dropdown-item">This month</a></li>
                                                        <li><a href="#" class="dropdown-item">This quarter</a></li>
                                                        <li><a href="#" class="dropdown-item">This year</a></li>
                                                        <li><a href="#" class="dropdown-item">Last month</a></li>
                                                        <li><a href="#" class="dropdown-item">Last quarter</a></li>
                                                        <li><a href="#" class="dropdown-item">Last year</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="moduleContent" style="height: 258px;">
                                        <div class="subContainer salesValues">
                                            <div class="paid moneySection">
                                                <div class="fancyMoney">$4</div>
                                                <div class="fancyText dataSelection">Last 30 Days</div>
                                            </div>
                                            <div id="sales-line-chart" style="height: 200px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss56">Messages</span>
                                    </h6>
                                </span>
                            </div>
                            <div class="msg-count-cus badge badge-pill badge-warning ml-auto px-1 py-1">
                                3
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 290px;overflow:scroll;">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">

                                    <div class="task-dashboard-cus wrapper d-flex align-items-center py-2 border-bottom">
                                      <img class="img-sm rounded-circle" src="http://placehold.it/43x43" alt="profile">
                                      <div class="wrapper ml-3">
                                        <h6 class="ml-1 mb-1">Denise Jacobs <small class="text-muted mb-0">&nbsp;10 minutes ago</small></h6>
                                        <small class="text-muted mb-0">Hi! i'd like to add you to Google</small>
                                      </div>
                                      <div class="ml-auto px-1 py-1">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                      </div>
                                    </div>

                                    <div class="task-dashboard-cus wrapper d-flex align-items-center py-2 border-bottom">
                                      <img class="img-sm rounded-circle" src="http://placehold.it/43x43" alt="profile">
                                      <div class="wrapper ml-3">
                                        <h6 class="ml-1 mb-1">Kyle Larson <small class="text-muted mb-0">&nbsp;4 minutes ago</small></h6>
                                        <small class="text-muted mb-0">Hi! i'd like to add you to Google</small>
                                      </div>
                                      <div class="ml-auto px-1 py-1">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                      </div>
                                    </div>

                                    <div class="task-dashboard-cus wrapper d-flex align-items-center py-2 border-bottom">
                                      <img class="img-sm rounded-circle" src="http://placehold.it/43x43" alt="profile">
                                      <div class="wrapper ml-3">
                                        <h6 class="ml-1 mb-1">Carl <small class="text-muted mb-0">&nbsp;2 minutes ago</small></h6>
                                        <small class="text-muted mb-0">Hi! i'd like to add you to Google</small>
                                      </div>
                                      <div class="ml-auto px-1 py-1">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                      </div>
                                    </div>

                                    <div class="task-dashboard-cus wrapper d-flex align-items-center py-2 border-bottom">
                                      <img class="img-sm rounded-circle" src="http://placehold.it/43x43" alt="profile">
                                      <div class="wrapper ml-3">
                                        <h6 class="ml-1 mb-1">Kyle Larson <small class="text-muted mb-0">&nbsp;4 minutes ago</small></h6>
                                        <small class="text-muted mb-0">Hi! i'd like to add you to Google</small>
                                      </div>
                                      <div class="ml-auto px-1 py-1">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                      </div>
                                    </div>

                                </div>
                               
                            </div>
                        </div>
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

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_5">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss85">Paid invoices</span>
                                    </h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 290px;">
                            <div class="MuiGrid-root jss78 MuiGrid-container">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                    <p class="MuiTypography-root jss77 MuiTypography-body1 MuiTypography-alignCenter">Paid</p>
                                </div>
                            </div>
                            <div class="MuiGrid-root MuiGrid-container">
                                <div class="MuiGrid-root jss83 MuiGrid-item MuiGrid-grid-xs-12" style="height: 300px;">
                                    <p class="MuiTypography-root jss79 MuiTypography-body1 MuiTypography-alignCenter">$0</p>
                                    <p class="MuiTypography-root jss80 MuiTypography-body1 MuiTypography-alignCenter">0</p>
                                    <p class="MuiTypography-root jss84 MuiTypography-body1 MuiTypography-alignCenter" type="subheading">all time paid invoices</p>
                                    <div class="MuiGrid-root jss81 MuiGrid-container MuiGrid-justify-xs-center">
                                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                            <a class="MuiButtonBase-root MuiButton-root MuiButton-text jss82 MuiButton-textPrimary" tabindex="0" aria-disabled="false" href="invoice">
                                            <span class="MuiButton-label">SEE REPORT</span>
                                            <span class="MuiTouchRipple-root"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_10">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Leads stats</span></h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="jss87">
                                <div class="MuiGrid-root jss88 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">All Leads</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$all_leads;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Assigned Leads</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$assigned_leads;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c66">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Unassigned Leads</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$unassigned_leads;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiGrid-root jss89 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                    <div class="c66 c161">
                                        <div class="c65 c72 c83 c160">
                                            <div class="c66">
                                                <p class="c162 c171">Total Converted Leads</p>
                                            </div>
                                            <div class="c66">
                                                <h3 class="c162 c169"><span><?=$converted_leads;?></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_10">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Overdue Invoices</span></h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px;">
                            <div class="jss87">
                                <table class="table table-bordered table-striped tbl-employee-attendance table-responsive" style="height: 223px;overflow:scroll;">
                                    <thead>
                                        <tr>
                                            <th>Job#</th>
                                            <th>Customer Name</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Amount Due</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_10">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                           <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Invoicing</span></h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 272px;">
                            <div class="jss87 height-full-custom">
                                <div class="d-flex block-invoicing-main height-full-custom">
                                    <div class="invoicing-block">
                                         <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Due</span></h6>
                                         <div class="block-detail">
                                             <h5 style="color: #ea2a6c;">$358,697</h5>
                                         </div>
                                         <h5>287</h5>
                                         <p>invice currently due</p>
                                    </div>
                                     <div class="invoicing-block">
                                         <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Paid</span></h6>
                                         <div class="block-detail">
                                             <h5>$1,703,460</h5>
                                         </div>
                                         <h5>1722</h5>
                                         <p>all time paid invoices</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex btn-fifty">
                            <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                                <div style="margin: auto;">
                                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false">
                                     
                                        <span class="MuiButton-label">See Report</span>
                                        <span class="MuiTouchRipple-root"></span>
                                                                    </a>
                                </div>
                            </div>
                            <div class="MuiCardActions-root jss112 MuiCardActions-spacing">
                                <div style="margin: auto;">
                                    <a class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" aria-disabled="false">
                                     
                                        <span class="MuiButton-label">See Report</span>
                                        <span class="MuiTouchRipple-root"></span>
                                                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id MuiGrid-tab-custom" id="item_11">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: auto; width: 100%; position: relative;">
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="c154" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="margin-right: -8px; position: relative; top: 1.4px;">
                                    <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1"><span class="jss55 jss91">Task stats</span></h6>
                                </span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 309px; overflow-x:scroll">
                            <div class="jss87">
                                <div class="MuiGrid-root jss88 MuiGrid-container MuiGrid-spacing-xs-3 MuiGrid-direction-xs-column">
                                <div class="custom-tabs">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#alltab" role="tab" aria-controls="alltab" aria-selected="true">All Tasks</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="my-tab" data-toggle="tab" href="#mytab" role="tab" aria-controls="mytab" aria-selected="false">My Tasks</a>
                                        </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="alltab" role="tabpanel" aria-labelledby="alltab">

                                        <div class="MuiCardContent-root jss60">
                                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">

                                                    <div class="message-box position-relative">
                                                        <div class="message-widget contact-widget position-relative">

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">S</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">Send Invoice</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 2 days delays</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">P</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">Pay Bill (Re: Adam Dee)</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 2 days delays</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-info msg-count-cus">N</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">New York Conference</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 10 days left</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-info msg-count-cus">I</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">Interview Maria</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 12 days left</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                        </div>
                                                    </div>

                                                </div>
                                            
                                            </div>
                                        </div>
                                        </div>
                                        <div class="tab-pane fade" id="mytab" role="tabpanel" aria-labelledby="mytab">
                                        <div class="MuiCardContent-root jss60">
                                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12" style="padding: 0px; margin: -8px;">

                                                    <div class="message-box position-relative">
                                                        <div class="message-widget contact-widget position-relative">

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">S</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">Send Invoice</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 2 days delays</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-danger msg-count-cus">P</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">Pay Bill (Re: Adam Dee)</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 2 days delays</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-info msg-count-cus">N</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">New York Conference</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 10 days left</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                            <a href="#" class="pb-3 px-2 border-bottom d-flex align-items-center text-decoration-none">
                                                                <div class="user-img position-relative d-inline-block mr-2"> <span class="round text-white text-center rounded-circle bg-info msg-count-cus">I</span>
                                                                </div>
                                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                                    <h5 class="text-truncate mb-0">Interview Maria</h5>
                                                                    <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block"><i class="fa fa-clock-o" aria-hidden="true"></i> 12 days left</span>
                                                                </div>
                                                                <div class="w-25 d-inline-block v-middle pl-2">
                                                                    <i class="fa fa-ellipsis-v float-right" aria-hidden="true"></i>
                                                                </div>
                                                            </a>

                                                        </div>
                                                    </div>

                                                </div>
                                            
                                            </div>
                                        </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-3 short_id" id="item_4">
                <div class="c65 c61">
                    <div class="MuiPaper-root MuiCard-root jss54 MuiPaper-elevation1 MuiPaper-rounded" style="cursor: pointer; width: 100%; position: relative;">
                        <div class="jss53">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column MuiGrid-align-items-xs-center MuiGrid-justify-xs-center">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-auto">
                                    <button class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary" tabindex="0" type="button">
                                    <span class="MuiButton-label">Set up your plans</span>
                                    <span class="MuiTouchRipple-root"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="MuiCardHeader-root" style="padding: 8px 16px; height: 48px; box-sizing: border-box;">
                            <div class="MuiCardHeader-avatar">
                                <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 24px; width: 24px; margin-right: -8px; position: relative; top: 1.4px;">
                                    <g>
                                        <path d="M6.535,10.29l6.585,6.683c0.289,0.294,0.723,0.294,1.013,0l1.663-1.689c0.362-0.294,0.362-0.806,0.072-1.028l-6.584-6.68 c0.651-1.689,0.29-3.671-1.085-5.066C6.752,1.042,4.582,0.748,2.844,1.555l3.112,3.157l-2.17,2.203L0.601,3.758 c-0.868,1.762-0.507,3.963,0.94,5.432C2.917,10.584,4.87,10.953,6.535,10.29z"></path>
                                        <path d="M21.708,12.354c-0.926-3.883-4.409-6.774-8.576-6.774c-0.538,0-1.06,0.062-1.571,0.154l0.518,2.057 c0.344-0.055,0.693-0.093,1.053-0.093c2.988,0,5.519,1.956,6.386,4.655H17.12l3.404,3.724l3.404-3.724H21.708z"></path>
                                        <path d="M13.132,21.115c-3.126,0-5.746-2.144-6.49-5.038h2.232L5.47,12.354l-3.404,3.723h2.403 c0.782,4.075,4.361,7.156,8.664,7.156c2.982,0,5.615-1.482,7.212-3.749l-1.784-1.177C17.345,20.001,15.375,21.115,13.132,21.115z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="MuiCardHeader-content">
                                <span class="">
                                    <h6 class="MuiTypography-root MuiTypography-subtitle1">
                                        <span class="jss55 jss74">Recurring service plans</span>
                                    </h6>
                                </span>
                            </div>
                            <div class="MuiCardHeader-action">
                                <span title="More actions" class="jss57"></span>
                            </div>
                        </div>
                        <p class="MuiTypography-root jss58 MuiTypography-body1"></p>
                        <div class="MuiCardContent-root jss60" style="height: 253px;">
                            <div class="MuiGrid-root MuiGrid-container MuiGrid-direction-xs-column">
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                    <div class="MuiGrid-root jss75 MuiGrid-container">
                                        <div class="MuiGrid-root jss76 MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6">
                                            <h1 class="MuiTypography-root MuiTypography-h1 MuiTypography-alignCenter">0</h1>
                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-alignCenter">Active service plans</div>
                                        </div>
                                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6">
                                            <h1 class="MuiTypography-root MuiTypography-h1 MuiTypography-colorError MuiTypography-alignCenter">0</h1>
                                            <div class="MuiTypography-root MuiTypography-caption MuiTypography-alignCenter">Agreements expire in 30 days</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="more tile-container" >
                    <div class="inner-container">
                        <div class="tileContent">
                            <div class="clear">
                                <div class="inner-content">
                                    <div class="header-container">
                                        <h3 class="header-content">Discover More</h3>
                                        <div class="header-separator">
                                            <div class="hs-content">
                                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                    <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                        <i class="fa fa-ellipsis-v fa-lg"></i></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" class="dropdown-item">Close, not relevant</a></li>
                                                        <li><a href="#" class="dropdown-item">Close, show me later</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="discoverMore-container">
                                        <div id="discoverMore" class="carousel slide" data-ride="carousel">
                                            <!-- The slideshow -->
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div style="position: relative;display: flex;align-items: center;justify-content: center;width: 280px;height: 85px;">
                                                        <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg" alt="Image1" width="100%" height="100%">
                                                    </div>
                                                    <div class="content-container">
                                                        <h3>Keep your signs with the times</h3>
                                                        <div class="sub-header-container">
                                                            Your team will know their rights. You'll be complaint. Update your labor law posters.
                                                        </div>
                                                        <div class="cta-container">
                                                            <a href="">Get your posters</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="card-content">
                                                        <h3>Share securely with others</h3>
                                                        <div class="divider-bar green-bar"></div>
                                                        <div class="divider-dot green-dot"></div>
                                                        <div class="sub-header">
                                                            New present custom roles help you delegate access, only in nSmartrac Online Advance.
                                                        </div>
                                                        <a href="#">See how it works</a>
                                                    </div>
                                                    <div class="card-img">
                                                        <div style="position:relative;display: flex;align-items: center;justify-content: center;">
                                                            <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104533/2_new-Bolt_lifestyle_TIPS_ACCOUNTING.svg" alt="Share securely with others" style="max-width: 100%;max-height: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="card-content">
                                                        <h3>Goodbye, paper timesheets!</h3>
                                                        <div class="divider-bar orange-bar"></div>
                                                        <div class="divider-dot orange-dot"></div>
                                                        <div class="sub-header">
                                                            Employees track time on any device, and it automatically appears in nSmartrac.
                                                        </div>
                                                        <a href="#">Try TSheets for Free</a>
                                                    </div>
                                                    <div class="card-img">
                                                        <div style="position:relative;display: flex;align-items: center;justify-content: center;">
                                                            <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104804/2_new-Bolt_lifestyle_TIPS_TIMETRACKING.svg" style="max-width: 100%;max-height: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="card-content">
                                                        <h3>Work even smarter</h3>
                                                        <div class="divider-bar green-bar"></div>
                                                        <div class="divider-dot green-dot"></div>
                                                        <div class="sub-header">
                                                            Easily track KPI is with automated performance dashboards in nSmartrac Online Advanced.
                                                        </div>
                                                        <a href="#">See how it works</a>
                                                    </div>
                                                    <div class="card-img">
                                                        <div style="position:relative;display: flex;align-items: center;justify-content: center;margin-top: 50px">
                                                            <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg" style="max-width: 100%;max-height: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div style="position: relative;display: flex;align-items: center;justify-content: center;width: 280px;height: 85px;">
                                                        <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg" alt="Image1" width="100%" height="100%">
                                                    </div>
                                                    <div class="content-container">
                                                        <h3>Pay worker's comp as you go</h3>
                                                        <div class="sub-header-container">
                                                            Do you know workers' comp can be automatically paid with payroll?
                                                        </div>
                                                        <div class="cta-container">
                                                            <a href="">Get started</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="card-content">
                                                        <h3>Find the right insurance</h3>
                                                        <div class="divider-bar gray-bar"></div>
                                                        <div class="divider-dot gray-dot"></div>
                                                        <div class="sub-header">
                                                            Explore affordable coverage options and protect your business right from nSmartrac.
                                                        </div>
                                                        <a href="#">See coverage option</a>
                                                    </div>
                                                    <div class="card-img">
                                                        <div style="position:relative;display: flex;align-items: center;justify-content: center;margin-top: 50px">
                                                            <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg" style="max-width: 100%;max-height: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Left and right controls -->
                                            <a class="carousel-control-prev" href="#discoverMore" data-slide="prev">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                            <a class="carousel-control-next" href="#discoverMore" data-slide="next">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                            <!-- Indicators -->
                                            <ul class="carousel-indicators" id="indicator">
                                                <li data-target="#discoverMore" data-slide-to="0" class="active"></li>
                                                <li data-target="#discoverMore" data-slide-to="1"></li>
                                                <li data-target="#discoverMore" data-slide-to="2"></li>
                                                <li data-target="#discoverMore" data-slide-to="3"></li>
                                                <li data-target="#discoverMore" data-slide-to="4"></li>
                                                <li data-target="#discoverMore" data-slide-to="5"></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    
        
        <!-- end row -->
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
        <div class="row d-none d-lg-flex sortable2">
            <?php
            /*$modules = explode(",", $dashboard_sort);
            for($x=0;$x<count($modules) -1;$x++){
            include viewPath('dashboard/'.$modules[$x]);
            }*/
            //  include viewPath('dashboard/report2');
            ?>

            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-12 MuiGrid-grid-md-4 MuiGrid-grid-lg-4 MuiGrid-grid-xl-2 short_id" id="item_14" style="padding: 0px 15px;">
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

        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2" id="sortable" style="margin-top: 8px;">

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
    $('#onoff-customize').click(function() {
        if(this.checked) {
            //var current = 1;
            // $( ".short_id" ).each(function( index ) {
            //     $('this').attr('id', 'item_'+current);
            //     current++;
            // });
            $("#sortable").sortable({
                /*stop: function(event, ui) {
                    alert("New position: " + ui.item.index());
                }*/
                start: function(e, div) {
                    // creates a temporary attribute on the element with the old index
                    $(this).attr('data-previndex', div.item.index());
                },
                update: function(e, div) {
                    // gets the new and old index then removes the temporary attribute
                    var newIndex = div.item.index();
                    var oldIndex = $(this).attr('data-previndex');
                    var element_id = div.item.attr('id');
                    //alert('id of Item moved = '+element_id+' old position = '+oldIndex+' new position = '+newIndex);
                    $(this).removeAttr('data-previndex');
                }
            });
            $("#sortable").disableSelection();
        }else{
            $( "#sortable" ).sortable( "disable" );
            //$( "#sortable" ).disableSelection();
        }
    });

    

    //$( ".sortable2" ).sortable( "enable" );
    /*$( ".sortable2" ).sortable({
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
           var new_module_sort = "";
           for(var x=0;x<idsInOrder.length;x++){
               if(x===0){
                   new_module_sort = new_module_sort + idsInOrder[x];
               }else{
                   new_module_sort = new_module_sort +","+idsInOrder[x];
               }
               console.log(idsInOrder[x]);
           }
           console.log(new_module_sort);
           $.ajax({
               type: "POST",
               url: "/dashboard/ac_dashboard_sort",
               data: {ds_values : new_module_sort,acds_id :  //echo $dashboard_sort->acds_id; ?>}, // serializes the form's elements.
               success: function(data)
               {
                   console.log(data);
               }
           });
       }
    });
    $( ".sortable2" ).sortable( "disable" ); */
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