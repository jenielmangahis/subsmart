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
    .page-title, .box-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
      padding-top: 0px;
      position: relative;
      bottom: 10px;
    }
    button.btn-info {
      background: #32253c !important;
    }
    .pr-b10 {
      position: relative;
      bottom: 15px;
    }
    .page-title-box {
        padding-bottom: 2px !important;
        padding-top: 10px !important;
    }
    .float-right.d-none.d-md-block {
        position: relative;
        top: 0px;
    }
    ul.nav.nav-tabs {
      margin-left: 20px;
      margin-right: 20px;
    }
    .p-40 {
      padding-top: 38px !important;
      padding-left: 30px !important;
    }
    .p-20 {
      padding-top: 35px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 5px !important;
    }
    button#addPayscale {
      border: 1px solid transparent;
      border-radius: 2px;
      box-shadow: none;
      font-size: 16px;
      transition: none;
      height: 38px;
      position: relative;
      bottom: 5px;
    }
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .float-right.d-none.d-md-block {
          position: relative;
          bottom: 0px;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box p-40">
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
                    <div class="card p-20">
                        <div class="card-body" style="padding: 0px !important;">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-bottom:0px !important;">Employees</h3>
                                <div class="pl-3 pr-3 mt-0 row">
                                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Track Employees Location.</span>
                                  </div>
                                </div>
                                <!--
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Track Employees Location</li>
                                </ol> -->
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
