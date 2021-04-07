<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;
        width: 100%;
    }
</style>

<!-- page wrapper start -->
<!-- <div class="wrapper" role="wrapper"> -->
<!--<div wrapper__section>-->
<div id="main_body" class="container-fluid" style="background-color: #6241A4">
    <div class="row">
        <div class="col-md-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-1">
                    </div>
                    <div class="col-sm-6">
                        <h1 class="page-title text-white">Trac360</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active text-white">Search the globe online</li>
                        </ol>
                    </div>
                    <div class="col-sm-5">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-2 pb-5">

        <!-- end row -->
    </div>
</div>
<h1>My Google Map</h1>
<div id="map"></div>
<!--</div>-->
<!-- end container-fluid -->
<!-- </div> -->

<!-- page wrapper end -->
<?php  ?>
<?php include viewPath('includes/footer'); ?>
</script>
<?php //echo $map_js;
?>

<script>
    function initMap() {
        var options = {
            zoom: 8,
            center: {
                lat: -34.397,
                lng: 150.644
            }
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8
        });
        var marker = new google.maps.Marker({
            position: {
                lat: -34.397,
                lng: 150.644
            },
            map: map
        });
    }
</script>

<script async src="https://maps.googleapis.com/maps/api/js?key=<?= $apiKey ?>&callback=initMap">