<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $page->title ?> | <?php echo $app->site_title ?> </title>

 	<meta name="description" content="Industry.INC HTML Template">
	<meta name="keywords" content="industry, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link href="<?php echo $url->assets ?>frontend/img/favicon.ico" rel="shortcut icon"/>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/magnific-popup.css"/>
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/slicknav.min.css"/>
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/owl.carousel.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/style.css"/>
	<link rel="stylesheet" href="<?php echo $url->assets ?>frontend/fonts/stylesheet.css"/>
	<link rel="stylesheet" href="https://allfont.net/css/lane-narrow.css" type="text/css" />


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>


	<!-- Header section  -->
	<header class="header-section clearfix">
		<div class="header-top">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-7">
						<p>HELP GROW YOUR BUSINESS WITH THE TOOL BUILT FOR YOU! <b class="ml-5 sc-33">CALL US AT <span class="blink">(844) 406-7286</span></b></p>
					</div>
					<div class="col-md-5 text-md-right desktop-only">
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
							<!-- <nav class="site-nav-menu1 ml-auto d-none d-md-block">
								<ul class="">
									<li class=""><a href="<?php //echo url('/login') ?>">Login</a></li>
									<li><a class="" href="<?php //echo url('/home/signup') ?>">Sign Up</a></li>
								</ul>
							</nav> -->
							<nav class="site-nav-menu ml-auto">
								<ul class="over-write-menu" style="margin-top:8px;">
									<li><a href="<?php echo url('/login') ?>">LOGIN</a></li>
									<li class="no-break"><a href="<?php echo url('/registration') ?>" class="">SIGN UP</a></li>
								</ul>
								<ul class="over-write-menu" style="margin-top:8px;">
									<li class=""><a href="<?php echo url('/') ?>">HOME</a></li>
									<li><a href="<?php echo url('/features') ?>">FEATURES</a></li>
									<li><a href="<?php echo url('/pricing') ?>">PRICING </a></li>
									<li><a href="<?php echo url('/contact') ?>">CONTACT</a></li>
									<li class="no-break"><a href="<?php echo url('/demo') ?>" class="no-break">DEMO</a></li>
                  <li class="mobile-only"><a href="<?php echo url('/login') ?>">LOGIN </a></li>
                  <li class="mobile-only"><a href="<?php echo url('/registration') ?>">SIGN UP</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end  -->
