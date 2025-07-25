<style>
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
#map-preview{
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
        <div class="card bg-primary mb-3">
            <div class="card-header">MAP</div>
            <div class="card-body" style="padding:0px;">
                <div class="form-group">
                    <div class="text-center map-container">
                        <div id="map-preview" class="map-preview"></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="card bg-primary mb-3">
            <div class="card-header">EVENT INFORMATION</div>
            <div class="card-body">
                <div class="row job-view-details">
                    <div class="col-md-4 col-12">
                        <div class="job-view-info">
                            <div class="label">DESCRIPTION</div>
                            <i class='bx bx-hash'></i> <?= $event->description; ?>
                        </div>                
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">DATE</div>
                        <i class='bx bx-calendar'></i>
                        <?php if( $event->start_date == $event->end_date ){ ?>
                            <?= date("l, F d, Y", strtotime($event->start_date)); ?><br />            
                        <?php }else{ ?>
                            <?= date("l, F d, Y", strtotime($event->start_date)); ?> - <?= date("l, F d, Y", strtotime($event->end_date)); ?><br />            
                        <?php } ?>
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">TIME</div>
                        <i class='bx bx-time'></i> <?= date("g:i A", strtotime($event->start_time)); ?> to <?= date("g:i A", strtotime($event->end_time)); ?>
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">TAGS</div>
                        <i class='bx bx-purchase-tag-alt' ></i> <?= $event->event_tag; ?>
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">TYPE</div>
                        <i class='bx bx-briefcase-alt-2'></i> <?= $event->event_type; ?>
                    </div>                    
                    <?php if( $show_job_address_description == 1 ){ ?>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">LOCATION</div>
                        <i class='bx bx-map'></i> <?= $event->event_address; ?>
                    </div>
                    <?php } ?>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">ATTENDEES</div>
                        <div class="d-flex align-items-center">
                            <?php $attendees = json_decode($event->employee_id); ?>
                            <?php foreach($attendees as $eid){ ?>
                                <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($eid); ?>'); width: 40px;"></div>
                            <?php } ?> 
                        </div>
                    </div>
                    <?php if( $event->notes != '' ){ ?>
                    <div class="col-md-4 col-12 mt-2">
                        <div class="label">NOTES</div>
                        <i class='bx bx-briefcase-alt-2'></i> <?= $event->notes; ?>
                    </div> 
                    <?php } ?>
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
            var address_line2  = '<?= $jobs_data->first_name .' '. $jobs_data->last_name; ?>';
    <?php } else { ?>
            var default_lat    = '39.7837304';
            var default_lon    = '-100.445882';   
            var map_zoom_level = '5';    
            var address_line2  = '<?= $jobs_data->first_name .' '. $jobs_data->last_name; ?>';
    <?php } ?>

    var map_style = 'osm-bright';

    var center = {
        lat: default_lat,
        lon: default_lon
    };  

    var geoMap = new maplibregl.Map({
    center: [center.lon, center.lat],
    zoom: map_zoom_level,
    container: 'map-preview',
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