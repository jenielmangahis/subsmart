<style>
.quick-view-schedule-container .title-border{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
.clear{
    clear:both;
}
#event-map-preview{
    height: 310px;
}
</style>
<div class="nsm-page-content quick-view-schedule-container" style="padding:2%;">
    <div class="row">
        <div class="col-md-5">
            <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="margin-top: 7px; max-height: 130px;" class="Logo"/> 
        </div>
        <div class="col-md-7">
            <table class="table-borderless mustRight" style="width:100%;">
                <tr>
                    <td colspan="2"><h1 style="text-align:right;"><b><?= $event->event_number; ?></b></h1></td>
                </tr> 
                <tr>
                    <td align="right">Event Tags:</td>
                    <td align="right"><b><?php echo $event->event_tag; ?></b></td>
                </tr>    
                <tr>
                    <td align="right">Event Type:</td>
                    <td align="right"><b><?php echo $event->event_type != '' ? $event->event_type : '---'; ?></b></td>
                </tr>     
                <tr>
                    <td align="right">Created By:</td>
                    <td align="right"><b><?php echo get_employee_name($event->created_by); ?></b></td>
                </tr>                
                <tr>
                    <td align="right" style="width:47%;">Scheduled Date:</td>
                    <td align="right">
                        <?php 
                            if( $event->start_date == $event->end_date ){
                                echo date('m/d/Y', strtotime($event->start_date));
                            }else{
                                echo date('m/d/Y', strtotime($event->start_date)) . ' to ' . date('m/d/Y', strtotime($event->end_date));
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">Scheduled Time:</td>
                    <td align="right"><?php echo $event->start_time.' to '.$event->end_time; ?></td>
                </tr>
            </table>            
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="nsm-card primary">
                <div class="row">    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div id="event-map-preview" class="event-map-preview"></div>
                                <!-- <iframe id="TEMPORARY_MAP_VIEW" src="http://maps.google.com/maps?q=<?= $event->event_address; ?>&output=embed" height="470" width="100%" style=""></iframe> -->
                            </div>
                            <div class="col-md-5">
                                <h6 class="title-border">ATTENDEES :</h6>
                                <?php 
                                    $assigned_employees = array();
                                    $emp_ids = json_decode($event->employee_id);
                                    if( is_array($emp_ids) ){
                                        foreach($emp_ids as $eid){
                                            $assigned_employees[] = $eid;    
                                        }
                                    }  
                                ?>
                                <?php foreach($assigned_employees as $eid){ ?>
                                    <div class="nsm-list-icon primary" style="background-color:#ffffff;display:inline-block;float:none !important;">
                                        <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');" data-img="<?= userProfileImage($eid); ?>"></div>                            
                                    </div>
                                <?php } ?>
                                <div class="clear"></div>
                                <hr />
                                <table class="table-borderless mustRight" style="width:100%;margin-top:30px;">
                                    <tr style="font-weight:bold;"><td>URL Link</td></tr>
                                    <tr><td><a target="_blank" href="<?= $event->url_link; ?>"><?= $event->url_link; ?></a></td></tr>
                                    <tr style="font-weight:bold;"><td>&nbsp;</td></tr>
                                    <tr style="font-weight:bold;"><td>Notes</td></tr>
                                    <tr><td><?= $event->notes; ?></a></td></tr>
                                </table>
                            </div>
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
            var address_line2  = '<?php echo $address_line2; ?>';
    <?php } else { ?>
            var default_lat    = '39.7837304';
            var default_lon    = '-100.445882';   
            var map_zoom_level = '5';    
            var address_line2  = '<?php echo $address_line2; ?>';
    <?php } ?>

    var map_style = 'osm-bright';

    var center = {
        lat: default_lat,
        lon: default_lon
    };  

    var geoMap = new maplibregl.Map({
    center: [center.lon, center.lat],
    zoom: map_zoom_level,
    container: 'event-map-preview',
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
    el.style.height = '50px';
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