<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">

	<?php if($page_title) { ?>
			<title><?php echo $page_title; ?></title>
	<?php } else { ?>
		<title>Nsmart</title>
	<?php } ?>

    <meta content="<?php echo $page_title; ?>" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->

    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style-booking.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>css/jquery.timepicker.css" rel="stylesheet" type="text/css">
     <!-- DataTables -->
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php //echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php //echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php //echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" /> -->

    <!-- <link rel="stylesheet" href="<?php //echo $url->assets ?>plugins/morris.js/morris.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- <script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

    <!-- Booking CSS -->
    <link rel="stylesheet" href="<?php echo $url->assets?>css/addons/booking.css">
    <!-- <link rel="stylesheet" href="<?php //echo $url->assets?>bootstrap/css/bootstrap.min.css"> -->
    <?php echo put_header_assets(); ?>

</head>

<body>
