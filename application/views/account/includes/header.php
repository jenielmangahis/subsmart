<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $assets ?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $assets ?>/plugins/Ionicons/css/ionicons.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $assets ?>/plugins/iCheck/square/blue.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $assets ?>/css/app.css">

  <!-- Login style -->
  <link rel="stylesheet" href="<?php echo $assets ?>/css/login.css">
  
  <!-- Canvas -->
  <!-- <link rel="stylesheet" href="<?php echo $assets ?>/signature.css">
  <link rel="stylesheet" href="<?php echo $assets ?>/libs/jcanvas/global.min.css"> -->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">
    /* Style the video: 100% width and height to cover the entire window */
    #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      top: -30px;
    }

    /* Add some content at the bottom of the video/page */
    .content {
      position: fixed;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      color: #f1f1f1;
      width: 100%;
      padding: 20px;
    }

    /* Style the button used to pause/play the video */
    #myBtn {
      width: 200px;
      font-size: 18px;
      padding: 10px;
      border: none;
      background: #000;
      color: #fff;
      cursor: pointer;
    }

    #myBtn:hover {
      background: #ddd;
      color: black;
    }
  </style>

</head>
<!-- <body class="hold-transition <?php //echo !isset($body_classes)?'login-page':$body_classes ?>" style="background-image: url('<?php //echo urlUpload('/login-bg.'.setting('bg_img_type'), true) ?>');"> -->
<body>
  <video autoplay muted playsinline loop id="myVideo">
    <source src="<?php echo $assets ?>/login-background-video.mp4" type="video/mp4">
  </video>
