<?php include viewPath('v2/includes/header'); ?>
<style>
<style>
#bev-map{
    height:600px;
    border:1px #6a4a86  solid;
}
.maplibregl-marker{
    background-size:cover;
    border-radius:34px;
}
.map-user, .map-address, .map-date{
    display:block;
}
.map-user{
    font-size:12px;
    font-weight:bold;
}
.autocomplete-left{
display: inline-block;
width: 65px;
}
.autocomplete-right{
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
.autocomplete-img {
    height: 50px;
    width: 50px;
}
.mapboxgl-popup-content, .maplibregl-popup-content{
  background-color:#6a4a86 !important;
  color:#ffffff !important;
}
.maplibregl-popup-tip{
    border-top-color : #6a4a86 !important;
}
.maplibregl-popup-close-button{
    color:#ffffff !important;
}
</style>
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/birds_eye_view_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <div class="row gx-3">
                        <div class="col-md-8 col-8">
                            <div class="nsm-card primary">
                                <div id="bev-map"></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-4">
                            <div class="nsm-card primary">
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>

<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>
<script type="text/javascript">
var myAPIKey = "41ddeb87ff654af488b283ba54ba576f";   
var default_lat = '8.8888';
var default_lon = '11.5812';

var center = {
    lat: default_lat,
    lon: default_lon
};
var map_zoom_level = '1'; 
var map_style = 'klokantech-basic';
var geojson = {
        'type': 'FeatureCollection',
    'features': <?= json_encode($geoDataFeatures); ?>
};

var map = new maplibregl.Map({
center: [center.lon, center.lat],
zoom: map_zoom_level,
container: 'bev-map',
style: `https://maps.geoapify.com/v1/styles/${map_style}/style.json?apiKey=${myAPIKey}`,
});
map.addControl(new maplibregl.NavigationControl()); 

// add markers to map
var currentMarkers=[];
// geojson.features.forEach((marker) => {
//     // create a DOM element for the marker
//     const el = document.createElement('div');
//     el.className = 'marker';    
//     el.style.backgroundImage =
//             `url(${marker.properties.image})`;
//     el.style.width = `${marker.properties.iconSize[0]}px`;
//     el.style.height = `${marker.properties.iconSize[1]}px`;

//     // el.addEventListener('click', () => {
//     //     window.alert(marker.properties.message);
//     // });

//     // create the popup
//     const popup = new maplibregl.Popup({offset: 25}).setHTML(
//         marker.properties.message
//     );

//     // add marker to map
//     var marker = new maplibregl.Marker({element: el})
//         .setLngLat(marker.geometry.coordinates)
//         .setPopup(popup)
//         .addTo(map);

//     currentMarkers.push(marker);
// });
</script>
