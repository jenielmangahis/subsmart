<style>
.view-schedule-container .bg-primary{
    background-color:#6a4a86;
}
.view-schedule-container .bg-primary{
    background-color:#6a4a86 !important;
}
.view-schedule-container .bg-primary .card-body{
    background-color:#f7f7f9;
}

.view-schedule-container .bg-primary .card-header{
    color:#ffffff;
}
.view-schedule-container .details{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.view-schedule-container .details li{
    font-size:17px;
    display:inline-block;
    width:49%;
    margin-bottom:0px;
    vertical-align:top;
}
.view-schedule-container .details li span.bx{
    width: 35px;
    display: inline-block;
    font-size: 20px;
    position: relative;
    top: 3px;
}
#map-ticket-preview{
    height: 310px;
}

.job-view-details{
    font-size: 15px;
}

.job-view-details .label{
    font-weight:bold;
    margin-bottom: 5px;
}
.nsm-list-icon {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
@media (max-width: 932px) {
    .view-schedule-container .details li {
        font-size: 17px;
        display: inline-block;
        width: 100% !important;
        margin-bottom: 0px;
        vertical-align:top;
    }

    .steps .step {
        display: inline-block !important;
        width: 20% !important;
    }
}

.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center
}

.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 40px;
    text-align: center
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}

.steps .step .step-icon-wrap::before {
    left: 0
}

.steps .step .step-icon-wrap::after {
    right: 0
}

.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 40px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 23px;
    line-height: 40px !important;
    z-index: 5
}

.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.steps .step:first-child .step-icon-wrap::before {
    display: none
}

.steps .step:last-child .step-icon-wrap::after {
    display: none
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
    background-color: #6a4a86
}

.steps .step.completed .step-icon {
    border-color: #6a4a86;
    background-color: #6a4a86;
    color: #fff
}

@media (max-width: 576px) {
    .flex-sm-nowrap .step .step-icon-wrap::before,
    .flex-sm-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 768px) {
    .flex-md-nowrap .step .step-icon-wrap::before,
    .flex-md-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 991px) {
    .flex-lg-nowrap .step .step-icon-wrap::before,
    .flex-lg-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 1200px) {
    .flex-xl-nowrap .step .step-icon-wrap::before,
    .flex-xl-nowrap .step .step-icon-wrap::after {
        display: none
    }
}
.bg-faded, .bg-secondary {
    background-color: #f5f5f5 !important;
}
.job-view-details i{
    position:relative;
    font-size:18px;
    top:2px;
}
</style>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                    <div class="step <?= $tickets->ticket_status == 'Scheduled' || $tickets->status != 'Draft' ? 'completed' : '' ?>">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class='bx bx-calendar'></i></div>
                        </div>
                        <h4 class="step-title">Scheduled</h4>
                    </div>
                    <div class="step <?= $tickets->ticket_status == 'Started' || $tickets->ticket_status == 'Finished' || $tickets->ticket_status == 'Invoiced' ? 'completed' : '' ?>">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class='bx bx-time-five'></i></div>
                        </div>
                        <h4 class="step-title">Start</h4>
                    </div>
                    <div class="step <?= $tickets->ticket_status == 'Finished' || $tickets->ticket_status == 'Invoiced' ? 'completed' : '' ?>">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class='bx bxs-flag-checkered'></i></div>
                        </div>
                        <h4 class="step-title">Finish</h4>
                    </div>
                    <div class="step <?= $tickets->ticket_status == 'Invoiced' ? 'completed' : '' ?>">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class='bx bx-receipt'></i></div>
                        </div>
                        <h4 class="step-title">Invoice</h4>
                    </div>
                </div>            
            
            </div>
        </div>
        <div class="card bg-primary mb-3">
            <div class="card-header">CUSTOMER</div>
            <div class="card-body">
                <div class="form-group">
                    <ul class="container details">
                        <li><p><span class='bx bx-user-circle'></span> <b><?= $tickets->first_name .' '. $tickets->last_name; ?></b></p></li>
                        <li><p><span class='bx bx-map'></span><?= $tickets->cust_city.', '.$tickets->cust_state.' '.$tickets->cust_zip_code; ?></p></li>
                        <li><p><span class='bx bx-phone'></span> <?= $tickets->phone_m !="" || $tickets->phone_m !=null ? formatPhoneNumber($tickets->phone_m) : 'N/A'; ?></p></li>
                        <li><p><span class='bx bx-envelope'></span><a href="mailto:<?= $tickets->cust_email; ?>"><?= $tickets->cust_email; ?></a></p></li>
                        <li><p><span class='bx bx-dollar-circle'></span> <?= number_format($tickets->grandtotal,2,'.',','); ?></p>
                    </ul>
                </div>
            </div>
        </div> 

        <div class="card bg-primary mb-3">
            <div class="card-header">MAP</div>
            <div class="card-body" style="padding:0px;">
                <div class="form-group">
                    <div class="text-center map-container">
                        <div id="map-ticket-preview"></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="card bg-primary mb-3">
            <div class="card-header">SERVICE TICKET INFORMATION</div>
            <div class="card-body">
                <div class="row job-view-details">
                    <div class="col-md-4 col-12">
                        <div class="job-view-info">
                            <div class="label">SERVICE TICKET NUMBER</div>
                            <i class='bx bx-hash'></i> <?= $tickets->ticket_no; ?>
                        </div>                
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">SERVICE TICKET TAGS</div>
                        <i class='bx bx-purchase-tag-alt'></i> <?= $tickets->job_tag != '' ? $tickets->job_tag : '---';  ?>
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">PANEL TYPE</div>
                        <i class='bx bx-trim'></i> <?= $tickets->panel_type != '' ? $tickets->panel_type : '---';  ?>
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="job-view-info">
                            <div class="label">DATE</div>
                            <i class='bx bx-calendar'></i><?= date("m/d/Y",strtotime($tickets->ticket_date)); ?>
                        </div>                
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="job-view-info">
                            <div class="label">TIME</div>
                            <i class='bx bx-time-five'></i>
                            <?php 
                                if( $tickets->scheduled_time != $tickets->scheduled_time_to ){
                                    echo $tickets->scheduled_time . ' to ' . $tickets->scheduled_time_to;
                                }else{
                                    echo $tickets->scheduled_time;
                                }
                            ?>
                        </div>                
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">ASSIGNED USERS</div>
                        <?php 
                            $assigned_employees = array();
                            $emp_ids = unserialize($tickets->technicians);
                            if( is_array($emp_ids) ){
                                foreach($emp_ids as $eid){
                                    $assigned_employees[] = $eid;    
                                }
                            }    

                            if( !empty($assigned_employees) ){
                                if( !in_array($tickets->sales_rep, $assigned_employees) ){
                                    $assigned_employees[] = $tickets->sales_rep;    
                                }                            
                            }else{
                                $assigned_employees[] = $tickets->sales_rep;    
                            }
                        ?>
                        <div class="techs">
                            <?php foreach($assigned_employees as $eid){ ?>
                                <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </div>
</div>
<script>
$(function(){
    var myAPIKey = "<?= GEOAPIKEY ?>";  
    <?php if($default_lat != "" && $default_lon != "") { ?>
            var default_lat    = '<?php echo $default_lat; ?>';
            var default_lon    = '<?php echo $default_lon; ?>';        
            var map_zoom_level = '11';  
            var address_line2  = '<?= $tickets->first_name .' '. $tickets->last_name; ?>';
    <?php } else { ?>
            var default_lat    = '39.7837304';
            var default_lon    = '-100.445882';   
            var map_zoom_level = '5';    
            var address_line2  = '<?= 'Location not found in map'; ?>';
    <?php } ?>

    var map_style = 'osm-bright';

    var center = {
        lat: default_lat,
        lon: default_lon
    };  

    var geoMap = new maplibregl.Map({
    center: [center.lon, center.lat],
    zoom: map_zoom_level,
    container: 'map-ticket-preview',
    style: `https://maps.geoapify.com/v1/styles/${map_style}/style.json?apiKey=${myAPIKey}`,
    });
    geoMap.addControl(new maplibregl.NavigationControl()); 
    var currentMarkers=[];

    var markerIcon = L.icon({
    iconUrl: `https://api.geoapify.com/v1/icon?size=xx-large&type=material&color=rgb(106,74,134)&icon=my_location&apiKey=${myAPIKey}`,
    iconSize: [38, 56], // size of the icon
    iconAnchor: [19, 51], // point of the icon which will correspond to marker's location
    popupAnchor: [0, -60] // point from which the popup should open relative to the iconAnchor
    });

    var coordinates = [default_lon, default_lat]
    var marker_color = 'mediumpurple';
    let map_icon = `https://api.geoapify.com/v1/icon?size=large&type=material&icon=business_center&noWhiteCircle=0&color=${marker_color}&apiKey=${myAPIKey}`;
    const el = document.createElement('div');
    el.className = 'marker';    
    el.style.width = '30px';
    el.style.color = marker_color;
    el.style.height = '45px';
    el.style.backgroundSize = "contain";
    el.style.backgroundImage = `url(${map_icon})`;    

    // create the popup
    const popup = new maplibregl.Popup({offset: 25}).setHTML(
        address_line2
    );

    // add marker to map
    var marker = new maplibregl.Marker({element: el})
        .setLngLat(coordinates)
        .setPopup(popup)
        .addTo(geoMap);

    currentMarkers.push(marker);  
});
</script>
