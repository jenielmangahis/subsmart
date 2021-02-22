<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row align-items-center mt-5 bg-white">
                <div class="card col-lg-12">
                    <div class="card-body" >
                        <div class="col-sm-12">
                            <h3 class="page-title">Bird Eye View</h3>
                            <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                <span style="color:black;">
                                    Get a birds-eye view of your calendar events and jobs’ location scheduled for the day.  With this tool your be able to see your team location and better position them to maximize the current day. 
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">

                                <div class="filter-container">
                                    <div class="dropdown dropdown-inline filter-date magbottompad">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span class="fa fa-calendar margin-right-sec"></span><span data-filter-date="selected-item-name"></span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li data-filter-date="item" data-date-start="2020-01-01" data-date-end="2020-12-31" data-name="This Year" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Year</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-10-01" data-date-end="2020-12-31" data-name="This Year - Q4" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Year - Q4</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-07-01" data-date-end="2020-09-30" data-name="This Year - Q3" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Year - Q3</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-04-01" data-date-end="2020-06-30" data-name="This Year - Q2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Year - Q2</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-01-01" data-date-end="2020-03-31" data-name="This Year - Q1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Year - Q1</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-10-01" data-date-end="2020-10-31" data-name="This Month" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Month</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-10-26" data-date-end="2020-11-01" data-name="This Week" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">This Week</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2019-01-01" data-date-end="2019-12-31" data-name="Previous Year" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Year</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2019-10-01" data-date-end="2019-12-31" data-name="Previous Year - Q4" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Year - Q4</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2019-07-01" data-date-end="2019-09-30" data-name="Previous Year - Q3" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Year - Q3</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2019-04-01" data-date-end="2019-06-30" data-name="Previous Year - Q2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Year - Q2</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2019-01-01" data-date-end="2019-03-31" data-name="Previous Year - Q1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Year - Q1</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-09-01" data-date-end="2020-09-30" data-name="Previous Month" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Month</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2020-10-19" data-date-end="2020-10-25" data-name="Previous Week" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Previous Week</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2018-01-01" data-date-end="2018-12-31" data-name="FY 2018" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">FY 2018</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2017-01-01" data-date-end="2017-12-31" data-name="FY 2017" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">FY 2017</a>
                                            </li>
                                            <li data-filter-date="item" data-date-start="2016-01-01" data-date-end="2016-12-31" data-name="FY 2016" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">FY 2016</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="margin-left" data-report="date-interval"></span>
                                    <span class="middot">&middot;</span> <a class="margin-right-sec" data-filter="date-range" href="#">Custom Dates</a>

                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="type_service">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span data-filter="selected-item-name"></span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li data-filter="item" data-value="" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">All Types</a>
                                            </li>
                                            <li data-filter="item" data-value="1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Residential (R)</a>
                                            </li>
                                            <li data-filter="item" data-value="2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Commercial (C)</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="status">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span data-filter="selected-item-name"></span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li data-filter="item" data-value="" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">All Statuses</a>
                                            </li>
                                            <li data-filter="item" data-value="1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">New</a>
                                            </li>
                                            <li data-filter="item" data-value="2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Scheduled</a>
                                            </li>
                                            <li data-filter="item" data-value="8" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Started</a>
                                            </li>
                                            <li data-filter="item" data-value="7" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Paused</a>
                                            </li>
                                            <li data-filter="item" data-value="3" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Completed</a>
                                            </li>
                                            <li data-filter="item" data-value="6" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Invoiced</a>
                                            </li>
                                            <li data-filter="item" data-value="5" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Withdrawn</a>
                                            </li>
                                            <li data-filter="item" data-value="4" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Closed</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="employee_id">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span data-filter="selected-item-name"></span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li data-filter="item" data-value="" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">All Employees</a>
                                            </li>
                                            <li data-filter="item" data-value="14278" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Alarm Direct</a>
                                            </li>
                                            <li data-filter="item" data-value="14291" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Brannon Nguyen</a>
                                            </li>
                                            <li data-filter="item" data-value="14281" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">TC Nguyen</a>
                                            </li>
                                            <li data-filter="item" data-value="14285" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Tommy Nguyen</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="map-container">
                                    <style>#map-canvas {width: 100%;height: 300px;}</style>
                                    <div id="map-canvas"></div>
                                    <script>
                                        function initMap() {
                                            var myLatLng = {lat: 1.523208409167528, lng: 103.67841453967287};

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
                                            });
                                        }
                                    </script>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzt0c6Rxf0SJo6bsCc046g7671s7TEj_U&callback=initMap&sensor=false" async defer></script>
                                </div>

                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
</div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>