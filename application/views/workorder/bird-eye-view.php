<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.dropdown .btn {
    padding: 6px 12px;
}
.dropdown .btn {
    padding: 6px 12px;
}
.btn-default {
    color: #363636;
    background: #fff;
    border: 1px solid #cccccc;
}
.btn {
    padding: 10px 25px;
    border: 1px solid transparent;
    border-radius: 2px;
    box-shadow: none;
    font-size: 16px;
    transition: none;
}
.btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
    <div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/schedule'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div class="col-sm-12 pl-0 pr-0">
                            <h3 class="mt-0 page-title pb-0 mb-0">Bird's Eye View</h3>
                            <span style="margin-top:4px;margin-bottom: 8px;display: block;font-size: 14px;color: rgba(42, 49, 66, 0.7);">Manage Bird's Eye View</span>
                        </div>
                        <div class="pl-3 pr-3 mt-1 row">
                          <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                              <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Get a birds-eye view of your calendar events and jobs’ location scheduled for the day.  With this tool your be able to see your team location and better position them to maximize the current day.</span>
                          </div>
                        </div>
                        <div class="filter-container mb-3">
                            
                            <!-- <select class="form-control">
                                <option value="all">All Types</option>
                                <option value="residential">Residential (R)</option>
                                <option value="coommercial">Commercial (C)</option>
                            </select>
                            <select class="form-control">
                                <option value="all">All Statuses</option>
                                <option value="new">New</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="started">Started</option>
                                <option value="paused">Paused</option>
                                <option value="completed">Completed</option>
                            </select>
                            <select class="form-control">
                                <option value="all">All Employees</option>
                                <option value="alarm_direct">Alarm Direct</option>
                                <option value="Brannon Nguyen">Brannon Nguyen</option>
                            </select> -->
                        </div>

                        <div class="map-container">
                            <style>#map-canvas {width: 100%;height: 50vh;}</style>
                            <div id="map-canvas"></div>
                            <script>
                                function initMap() {
                                  /*var myLatLng = {lat: 1.523208409167528, lng: 103.67841453967287};

                                  // Create a map object and specify the DOM element for display.
                                  var map = new google.maps.Map(document.getElementById('map-canvas'), {
                                    center: myLatLng,
                                    // scrollwheel: false,
                                    zoom: 16
                                  });

                                  // Create a marker and set its position.
                                  var marker = new google.maps.Marker({
                                    map: map,
                                    position: myLatLng,
                                    title: 'Regalia large and amazing room!'
                                  });*/
                                  /*var locations = [
                                      ['Bondi Beach', 121.1125667, 14.2885935, 4],
                                      ['Coogee Beach', -33.923036, 151.259052, 5],
                                      ['Cronulla Beach', -34.028249, 151.157507, 3],
                                      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
                                      ['Maroubra Beach', -33.950198, 151.259302, 1]
                                    ];*/
                                 /*var locations = [
                                    ['test abc', 121.1125667, 14.2885935, 4],
                                    ['Sample Event', 121.1067332, 14.2935521, 3],
                                    ['TEST ABC 1', 121.0781493, 14.3036345, 2],
                                    ['EVENT LOCATION B', 121.0458348, 14.3528609, 1]
                                ];*/
                                var locations = [<?= implode(",", $locations); ?>];

                                    var map = new google.maps.Map(document.getElementById('map-canvas'), {
                                      zoom: 10,
                                      center: new google.maps.LatLng(<?php echo $center_lat; ?>, <?php echo $center_lng; ?>),
                                      mapTypeId: google.maps.MapTypeId.ROADMAP
                                    });

                                    var infowindow = new google.maps.InfoWindow();

                                    var marker, i;

                                    for (i = 0; i < locations.length; i++) {
                                      marker = new google.maps.Marker({
                                        text: 'Test',
                                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                        map: map,
                                        /*icon: {
                                          url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                                          labelOrigin: new google.maps.Point(75, 32),
                                          size: new google.maps.Size(32,32),
                                          anchor: new google.maps.Point(16,32)
                                        },
                                        label: {
                                          text: locations[i][0],
                                          color: "#C70E20",
                                          fontWeight: "bold"
                                        }*/
                                      });

                                      google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                        return function() {
                                          infowindow.setContent(locations[i][0]);
                                          infowindow.open(map, marker);
                                        }
                                      })(marker, i));
                                    }
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&callback=initMap"></script>
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
<?php include viewPath('includes/footer'); ?>
