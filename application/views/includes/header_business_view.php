<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>nSmarTrac</title>
    <meta content="nSmarTrac" name="description">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?php echo $url->assets?>plugins/font-awesome/css/font-awesome.min.css">

    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/style-business.css"/>
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <?php echo put_header_assets(); ?>
</head>
<body style="background: white !important;">
	<!-- Header section  -->
	<header class="header-section clearfix">
		<div class="header-top">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-9 desktop-only">
						<p>GROW YOUR BUSINESS WITH THE TOOL BUILT FOR YOU! <b class="ml-5 pl-4 sc-33">CALL US AT <span class="blink">(844) 406-7286</span></b> FOR BETTER COMPANY AUTOMATION</p>
					</div>
        	<div class="col-md-10 mobile-only">
          	<p>GROW YOUR BUSINESS WITH THE TOOL BUILT FOR YOU! <b class="ml-5 sc-33">CALL US AT <span class="blink">(844) 406-7286</span></b> FOR BETTER COMPANY AUTOMATION</p>
        	</div>
					<div class="col-md-3 text-md-right desktop-only">
            <ul class="account-menu">
              <li><a href="<?php echo url('/login') ?>">LOGIN</a></li>
              <li class="no-break"><a href="<?php echo url('/registration') ?>" class="">SIGN UP</a></li>
            </ul>
						<div class="footer-social text-right">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-navbar">
			<div class="container">
				<div class="row">
					<div class="col-12 d-flex align-items-center site-logo-holder">
						<!-- Logo -->
						<a href="http://nsmartrac.com/" class="site-logo">
							<img width="300" src="<?php echo $url->assets ?>frontend/images/logo.png" alt="">
						</a>
						<div style="margin-left: auto; text-align: right;">
							<nav class="site-nav-menu ml-auto">
								<!-- <ul class="over-write-menu" style="margin-top:8px;">
									<li><a href="<?php echo url('/login') ?>">LOGIN</a></li>
									<li class="no-break"><a href="<?php echo url('/registration') ?>" class="">SIGN UP</a></li>
								</ul> -->
								<ul class="over-write-menu" style="margin-top:21px;">
									<li class=""><a href="<?php echo url('/') ?>">HOME</a></li>
									<li class=""><a href="<?php echo url('/about') ?>">ABOUT US</a></li>
									<li><a href="<?php echo url('/features') ?>">FEATURES</a></li>
									<li><a href="<?php echo url('/pricing') ?>">PRICING </a></li>
									<li><a href="<?php echo url('/contact') ?>">CONTACT</a></li>
									<li><a href="<?php echo url('/find-pros') ?>">FIND PRO</a></li>
									<li class=""><a href="<?php echo url('/demo') ?>" class="no-break">DEMO</a></li>
                  <li class="no-break desktop-only-b"><a href="#" class="no-break dl-home desktop-only">DOWNLOAD</a></li>
                  <li class="mobile-only"><a href="#">DOWNLOAD </a></li>
					        <li class="mobile-only"><a href="<?php echo url('/login') ?>">LOGIN </a></li>
					        <li class="mobile-only"><a href="<?php echo url('/registration') ?>">SIGN UP</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="col-12 d-flex align-items-center site-logo-holder">

					</div>
				</div>
			</div>
		</div>
	</header>
    <br class="clear"/>
	<!-- Header section end  -->
