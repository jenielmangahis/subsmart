<div class="trac360-live-jobs-modal">
    <div class="trac360-live-jobs-modal-body">
        <div class="trac360-close-btn">
            <img
                src="<?=base_url('/assets/img/trac360/close.png')?>" />
        </div>
        <div class="trac360-live-jobs-content" style="height: 100%;">
            <div class="trac360-live-jobs" style="height: 100%;">
                <div class="row no-margin" style="height: 100%;">
                    <div class="col-md-4 no-padding overflow-auto" style="height: 100%;">
                        <div class="employee-name" style="min-width:439px;">
                            <span class="name">asdasd asdasd</span>
                        </div>
                        <div id="job-item-selected-view" class="row no-margin">
                            <div class="col-md-4 job-sched text-center">
                                <a href="#">
                                    <time style="font-size: 10px; text-align: left;" datetime="2021-02-09"
                                        class="icon-calendar-live">
                                        <em>Thu</em>
                                        <strong style="background-color: #58c04e;">Jun</strong>
                                        <span>03</span>
                                    </time>
                                </a>
                                <div class="job-status text-center mb-2" style="color:#ffffff;">
                                    <b>SCHEDULED</b>
                                </div>
                                <span class="text-center after-status">ARRIVAL TIME</span><br>
                                <span class="job-caption text-center">
                                    9:30 am-1:30 pm </span>
                            </div>
                            <div class="col-md-8 job-details">
                                <a style="color: #000!important;" href="#">
                                    <h6
                                        style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                                        JOB - 00000026 : Takeover - IP Sync </h6>
                                    <b style="color:#45a73c;">
                                        tim george </b><br>
                                    <small class="text-muted">6867 Pine Forest Rd, Pensacola FL 32526</small><br>
                                    <i> <small class="text-muted"></small></i><br>
                                    <small>Amount : $ 0.00</small>
                                    <br>
                                </a><a href="" target=""><small style="color: darkred;"></small></a>
                            </div>
                        </div>
                        <div class="office-customer">
                            <table class="route-details-table">
                                <tbody class="tbody">
                                    <tr class="last-coords-details first-info" data-i="0">
                                        <td class="connected-icon">
                                            <div><i class="fa fa-building" aria-hidden="true"></i></div>
                                        </td>
                                        <td>
                                            <div class="address office">Pan-Philippine Hwy
                                                Panabo, Davao del Norte</div>
                                            <div class="date-time office">Office: May 26, 2021 07:36 PM</div>
                                        </td>
                                    </tr>
                                    <tr class="last-coords-details last-info" data-i="1">
                                        <td class="connected-icon">
                                            <div><i class="fa fa-home" aria-hidden="true"></i></div>
                                        </td>
                                        <td>
                                            <div class="address customer">Tadeco Rd
                                                Panabo, Davao del Norte</div>
                                            <div class="date-time customer">Customer: May 26, 2021 07:36 PM</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="route-details-setion">
                            <table class="route-details-table">
                                <tbody class="tbody">
                                    <tr class="last-coords-details first-info" data-i="0">
                                        <td class="connected-icon">
                                            <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                        </td>
                                        <td>
                                            <div class="address">Pan-Philippine Hwy
                                                Panabo, Davao del Norte</div>
                                            <div class="date-time">May 26, 2021 07:36 PM</div>
                                        </td>
                                    </tr>
                                    <tr class="last-coords-details middle-info" data-i="1">
                                        <td class="connected-icon">
                                            <div><i class="fa fa-stop-circle" aria-hidden="true"></i></div>
                                        </td>
                                        <td>
                                            <div class="address">Tadeco Rd
                                                Panabo, Davao del Norte</div>
                                            <div class="date-time">May 26, 2021 07:36 PM</div>
                                        </td>
                                    </tr>
                                    <tr class="last-coords-details middle-info" data-i="2">
                                        <td class="connected-icon">
                                            <div><i class="fa fa-car" aria-hidden="true"></i></div>
                                        </td>
                                        <td>
                                            <div class="address">Panabo
                                                Davao del Norte</div>
                                            <div class="date-time">May 26, 2021 07:38 PM</div>
                                        </td>
                                    </tr>
                                    <tr class="last-coords-details last-info" data-i="3">
                                        <td class="connected-icon">
                                            <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                        </td>
                                        <td>
                                            <div class="address">Panabo
                                                Davao del Norte</div>
                                            <div class="date-time">May 26, 2021 07:38 PM</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div id="live-map-holder">
                            <div id="live-map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var live_map;
    var live_job_id;
    var live_employee_id;
    var live_last_route_id;
    var live_map_marker = [];
    var antennasCircle_live_map;
    var live_directionsService;
    var live_directionsRenderer;
    var live_infoWindow;
    var expected_live_directionsService;
    var expected_live_directionsRenderer;
    var expected_live_map_marker = [];
    var autoclockout_checker_loop;

    function initLiveMap() {
        live_map = new google.maps.Map(document.getElementById("live-map"), {
            center: {
                lat: 37.0902,
                lng: 95.7129
            },
            fullscreenControl: false,
            zoom: 2,
        });
    }
</script>