<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /*Tabs*/
    .tab-pane{
        margin-top: 20px;
    }
    .nav-item .active{
        border-bottom: 3px solid #498002!important;
        background-color: transparent!important;
        font-weight: bold;
    }
    .nav-tabs .nav-link{
        border: 0;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <!--<div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Employees</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Track Employees Location</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">

                        </div>
                    </div>
                </div>-->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-6">
                                <h3 class="page-title">Employees</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Track Employees Location</li>
                                </ol>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#trackMap">Map</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#trackPlaces">Add Places</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#trackSettings">Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane container active" id="trackMap">
                                    <div id="googleMap" style="width:100%;height:400px;"></div>
                                </div>
                                <div class="tab-pane container fade" id="trackPlaces">
                                </div>
                                <div class="tab-pane container fade" id="trackSettings">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    function myMap() {
        let mapProp= {
            center:new google.maps.LatLng(29.8134,-95.4641),
            zoom:5,
        };
        let map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4&callback=myMap"></script>
