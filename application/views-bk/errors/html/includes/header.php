<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $heading ?></title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="<?php echo config_item('base_url').'/assets/' ?>img/favicon.png">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>bootstrap/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/Ionicons/css/ionicons.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/datatables.net/export/buttons.bootstrap.min.css" />
  
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/select2/dist/css/select2.min.css" />

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/bootstrap-daterangepicker/daterangepicker.css" />
  
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />

  <?php if(function_exists('styles_header')) styles_header($url) ?>

  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Uncomment the below code if you want to use official AdminLte Theme -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>css/AdminLTE.min.css"> -->

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>/css/app.css" />
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo config_item('base_url').'/assets/' ?>css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery 3 -->
  <script src="<?php echo config_item('base_url').'/assets/' ?>js/jquery/jquery.min.js"></script>


  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo config_item('base_url').'/assets/' ?>plugins/jqueryUi/jquery-ui.min.js"></script>

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $.widget.bridge('uibutton', $.ui.button);
  </script>

  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo config_item('base_url').'/assets/' ?>bootstrap/js/bootstrap.min.js"></script>
  
  <!-- SlimScroll -->
  <script src="<?php echo config_item('base_url').'/assets/' ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <!-- FastClick -->
  <script src="<?php echo config_item('base_url').'/assets/' ?>plugins/fastclick/lib/fastclick.js"></script>


  <style>
    .img-avtar{
      border-radius: 50%;
    }

    div.dataTables_wrapper div.dataTables_filter{

      text-align: left;

    }
  </style>


</head>
<body class="hold-transition skin-custom">
<!-- Site wrapper -->
<div class="wrapper">

