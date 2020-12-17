<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
  
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->

    <link href="<?php echo $url->assets ?>wizard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>wizard/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>wizard/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>wizard/css/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>wizard/css/slick.min.css" rel="stylesheet" type="text/css">
     <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>css/jquery.signaturepad.css" >
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet">
    <!-- dynamic assets goes  -->
    <?php echo put_header_assets(); ?>
    <style type="text/css">
        #signature{
                width: 100%;
                height: 200px;
                border: 1px solid black;
            }
        #topnav {
            font-family: "Ubuntu","Trebuchet MS",sans-serif !important;
        }
    </style>
    <style type="text/css">
        .slide-ic img {
    display: inline-block !important;
    width: 25px;
    margin: 0 5px;
}
    </style>
</head>

<body>
    <!-- Navigation Bar-->
    <header id="topnav">
	<input type="hidden" id="siteurl" value="<?php echo url();?>"> <!-- for js programing -->
        <div class="topbar-main">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo container-->
                    <div class="logo col-auto d-none d-lg-inline-flex"><a href="<?php echo url('dashboard');?>" class="logo">
                        <img width="200" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a>
                    </div><!-- End Logo container-->
                    <!-- MENU Start -->

                    <?php include viewPath('includes/nav'); ?>
                    <div class="menu-extras topbar-custom col-auto justify-content-end">
                        <ul class="navbar-right list-inline float-right mb-0">
							<li class="menu-item list-inline-item">
                                <a class="navbar-toggle nav-link">
                                    <div class="lines"><span></span> <span></span> <span></span></div>
                                </a>
                            </li>
							<li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img width="100" height="25" style="height: 25px !important;width: 100px !important;" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a></li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="/users/timesheet_user" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-clock-o" aria-hidden="true"></i></a>

                            </li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                            </li>
							                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>

                            </li>


							 <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa fa-line-chart" aria-hidden="true"></i></a>

                            </li>


                            <li class="dropdown notification-list list-inline-item ml-auto">
                                <a class="nav-link dropdown-toggle arrow-none" href="<?php echo base_url('settings/tax_rates') ?>">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </a>
                            </li>
							<li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i> <span class="badge badge-pill badge-danger noti-icon-badge">3</span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text">Notifications (258)</h6>
                                    <div class="slimscroll notification-item-list">
                                    <?php $reorders = getReorderItemsCount();
                                        $reorders_count = 0;
                                        if($reorders){
                                            foreach ($reorders as $key => $reorder) {
                                                if(!is_null($reorder['total_count'])){
                                                    if($reorder['reorder_point'] > $reorder['total_count']){
                                                        $reorders_count++;
                                                    }
                                                }    
                                            }
                                        }
                                    ?>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Item needs to reorder (<?php echo $reorders_count;?>)<span class="text-muted">Please replenish immediately.</span></p>
                                    </a>
										<a href="javascript:void(0);" class="dropdown-item notify-item active"><div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div><p class="notify-details">Your order is placed<span class="text-muted">Dummytext of the printing and typesetting industry.</span></p>
                                        </a>
										<a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                        </a>
										<a href="javascript:void(0);" class="dropdown-item notify-item">
											<div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                            <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                                        </a> <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details">Your order is placed<span class="text-muted">Dummy
                                                    text of the printing and typesetting industry.</span></p>
                                        </a>  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                            </div>
                                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                        </a>
									</div><!-- All--> <a href="javascript:void(0);"
									class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                                </div>
                            </li>
                            <?php $newtasks = getNewTasks(); ?>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="" role="button" aria-haspopup="false" aria-expanded="false"><i style=""class="fa fa-calendar-check-o" aria-hidden="true"></i><?php if(count($newtasks) > 0){ ?><span class="badge badge-pill badge-danger noti-icon-badge"><?php echo count($newtasks); ?></span>
                                    <?php } ?></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text"><?php if(count($newtasks) > 0){ echo 'New Tasks (' . count($newtasks) . ')'; } else { echo 'No New Tasks'; } ?></h6>
                                    <div class="slimscroll notification-item-list">
                                        <?php foreach ($newtasks as $key => $value) { ?>
                                            <a href="<?php echo base_url('taskhub/view/' . $value['task_id']); ?>" class="dropdown-item notify-item active"><div class="notify-icon bg-success"></div><p class="notify-details"><?php echo $value['subject']; ?><span class="text-muted">
                                                <?php
                                                    $date_created = date_create($value['date_created']);
                                                    echo date_format($date_created, "F d, Y h:i:s");
                                                ?>
                                            </span></p>
                                        </a>
                                        <?php } ?>
                                    </div><!-- All--> <a href="<?php echo base_url('taskhub') ?>"
                                    class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="dropdown notification-list list-inline-item">
                                <div class="dropdown notification-list nav-pro-img">
                                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <?php /*<img src="<?php //echo (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets ?>" alt="user" class="rounded-circle">*/ ?>
                                        <?php 
                                            /*$image = (userProfile(logged('id'))) ? userProfile(logged('id')) : $url->assets;
                                            if( !@getimagesize($image) ){
                                                $image = base_url('uploads/users/default.png');
                                            }*/
                                            $image = base_url('uploads/users/default.png');
                                        ?>
                                        <img src="<?php echo userProfileImage(logged('id')) ?>" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                        <a class="dropdown-item" href="<?php echo url('dashboard')?>"><i class="mdi mdi-account-circle m-r-5"></i>Dashboard</a>
                                        <a class="dropdown-item" href="<?php echo url('profile')?>"><i class="mdi mdi-account-circle m-r-5"></i>Public Profile</a>
                                        <a class="dropdown-item" href="<?php echo url()?>"><i class="mdi mdi-account-circle m-r-5"></i>nSmart Home</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>Join our community</a>
										<?php //if (hasPermissions('activity_log_list')): ?>
											<a href="<?php echo url('activity_logs') ?>">
											<i class="mdi mdi-account-circle m-r-5"></i><span>Activity Logs</span>
											</a>
										<?php //endif ?>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="<?php echo url('/logout') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div><!-- end menu-extras -->
                    <div class="clearfix"></div>
                </div><!-- end container -->
            </div><!-- end container -->
        </div><!-- end topbar-main -->

    </header><!-- End Navigation Bar-->
