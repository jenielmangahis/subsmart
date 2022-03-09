<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->
     
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">     
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
     <!-- DataTables --> 
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  
    
</head>
<body>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div>
        <div class="container-fluid p-40">
            <div class="row ">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="row ">
                            <div class="col-md-12">
                                <div style="margin-top: 5px;">
                                    <b>Account No: </b><span>  <?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---';?></span>&nbsp;&nbsp;&nbsp;
                                    <b>Online: </b><span> <?= !empty($alarm_info->online) ? $alarm_info->online : '---';?></span>&nbsp;&nbsp;&nbsp;
                                    <b>In Service: </b><span> <?= !empty($alarm_info->in_service) ? $alarm_info->in_service : '---';?></span> &nbsp;&nbsp;
                                    <b>Status: </b><span> <?= !empty($profile_info->status) ? $profile_info->status : '---';?> </span>&nbsp;&nbsp;&nbsp;
                                    <b>Equipment: </b><span> <?= !empty($alarm_info->equipment) ? $alarm_info->equipment : '---';?> </span>&nbsp;&nbsp;&nbsp;
                                    <b>Collections: </b><span><?= !empty($alarm_info->collections) ? $alarm_info->collections : '---';?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-"></div>
            <div class="row mt-2">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row" id="customer-details-container">
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/preview_customer_info'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/preview_office_info'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/preview_alarm_info'); ?>
                        </div>
                        <div class="col-md-12">
                            <?php include viewPath('customer/advance_customer_forms/preview_notes_info'); ?>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
        <!-- end container-fluid -->
</div>
 <?php include viewPath('customer/js/preview_js'); ?>
 <script>
    window.onload = function() { window.print(); }
 </script>
</body>
</html>       
