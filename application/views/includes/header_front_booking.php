<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">

	<?php if($page_title) { ?>
			<title><?php echo $page_title; ?></title>
	<?php } else { ?>
		<title>nSmartrac : Online Booking</title>
	<?php } ?>

    <meta content="<?php echo $page_title; ?>" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->

    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style-booking.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>css/jquery.timepicker.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Booking CSS -->
    <link rel="stylesheet" href="<?php echo $url->assets?>css/addons/booking.css">
    <!-- <link rel="stylesheet" href="<?php //echo $url->assets?>bootstrap/css/bootstrap.min.css"> -->
    <?php echo put_header_assets(); ?>

    <script>  
        var base_url = "<?php echo base_url(); ?>";
    </script>

</head>

<body>
